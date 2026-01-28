// Simple HTTP Server - No external dependencies
import http from 'http';
import fs from 'fs';
import path from 'path';
import { fileURLToPath, URL } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const PORT = 3000;

// Load courses
function getCourses() {
    try {
        const data = fs.readFileSync(path.join(__dirname, 'data/courses.json'), 'utf8');
        return JSON.parse(data).courses || [];
    } catch (e) {
        console.error('Error loading courses:', e.message);
        return [];
    }
}

// Start server
const server = http.createServer((req, res) => {
    // CORS
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET,OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
    res.setHeader('Content-Type', 'application/json');

    if (req.method === 'OPTIONS') {
        res.writeHead(200);
        res.end();
        return;
    }

    const url = new URL(req.url, `http://${req.headers.host}`);
    const path_name = url.pathname;
    const query = Object.fromEntries(url.searchParams);

    // Routes
    if (path_name === '/' && req.method === 'GET') {
        res.writeHead(200);
        res.end(JSON.stringify({ status: 'ok', message: 'WHTECH API' }));
    } else if (path_name === '/api/courses' && req.method === 'GET') {
        const courses = getCourses();
        res.writeHead(200);
        res.end(JSON.stringify({ success: true, data: courses, total: courses.length }));
    } else if (path_name === '/api/courses/search' && req.method === 'GET') {
        const courses = getCourses();
        const q = (query.q || '').toLowerCase();
        const category = query.category || '';
        const page = parseInt(query.page) || 1;
        const perPage = parseInt(query.per_page) || 9;

        let filtered = courses;
        if (q) {
            filtered = filtered.filter(c =>
                c.name.toLowerCase().includes(q) ||
                c.course_code.toLowerCase().includes(q) ||
                c.lecturer.toLowerCase().includes(q)
            );
        }
        if (category) {
            filtered = filtered.filter(c => c.category === category);
        }

        const total = filtered.length;
        const lastPage = Math.ceil(total / perPage);
        const data = filtered.slice((page - 1) * perPage, page * perPage);

        res.writeHead(200);
        res.end(JSON.stringify({
            success: true,
            data,
            pagination: { current_page: page, last_page: lastPage, total, per_page: perPage }
        }));
    } else {
        res.writeHead(404);
        res.end(JSON.stringify({ success: false, message: 'Not found' }));
    }
});

server.listen(PORT, () => {
    console.log(`🚀 Server running on http://localhost:${PORT}`);
});

// Keep server alive
process.on('SIGTERM', () => process.exit(0));
