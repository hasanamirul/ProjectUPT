import http from 'http';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import { URL } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Load courses data
function loadCourses() {
    const coursesPath = path.join(__dirname, 'data', 'courses.json');
    const data = fs.readFileSync(coursesPath, 'utf8');
    return JSON.parse(data).courses;
}

// Enable CORS headers
function setHeaders(res) {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
    res.setHeader('Content-Type', 'application/json');
}

// Parse query parameters
function parseQuery(queryString) {
    const params = {};
    if (queryString) {
        new URL('http://example.com?' + queryString).searchParams.forEach((value, key) => {
            params[key] = value;
        });
    }
    return params;
}

// Search courses
function searchCourses(queryString) {
    const courses = loadCourses();
    const params = parseQuery(queryString);

    const query = params.q ? params.q.toLowerCase() : '';
    const category = params.category || '';
    const page = parseInt(params.page) || 1;
    const perPage = parseInt(params.per_page) || 9;

    // Filter by search query
    let filtered = courses;
    if (query) {
        filtered = filtered.filter(c =>
            c.name.toLowerCase().includes(query) ||
            c.course_code.toLowerCase().includes(query) ||
            c.lecturer.toLowerCase().includes(query) ||
            c.description.toLowerCase().includes(query)
        );
    }

    // Filter by category
    if (category) {
        filtered = filtered.filter(c => c.category === category);
    }

    // Pagination
    const total = filtered.length;
    const lastPage = Math.ceil(total / perPage);
    const startIndex = (page - 1) * perPage;
    const paginatedData = filtered.slice(startIndex, startIndex + perPage);

    return {
        success: true,
        data: paginatedData,
        pagination: {
            current_page: page,
            last_page: lastPage,
            total: total,
            per_page: perPage,
        },
    };
}

// Get all courses
function getAllCourses() {
    const courses = loadCourses();
    return {
        success: true,
        data: courses,
        total: courses.length,
    };
}

// Get single course
function getCourseById(id) {
    const courses = loadCourses();
    const course = courses.find(c => c.id === id);

    if (!course) {
        return {
            success: false,
            message: 'Course not found',
        };
    }

    return {
        success: true,
        data: course,
    };
}

// Create server
const server = http.createServer((req, res) => {
    const urlObj = new URL(req.url, `http://${req.headers.host}`);
    const pathname = urlObj.pathname;
    const queryString = urlObj.search.slice(1);

    setHeaders(res);

    // Handle OPTIONS for CORS
    if (req.method === 'OPTIONS') {
        res.writeHead(200);
        res.end();
        return;
    }

    // Routes
    if (req.method === 'GET') {
        if (pathname === '/') {
            res.writeHead(200);
            res.end(JSON.stringify({
                message: 'WHTECH Mini-Portal Akademik API',
                version: '1.0.0',
                status: 'running',
            }));
            return;
        }

        if (pathname === '/api/courses/search') {
            res.writeHead(200);
            res.end(JSON.stringify(searchCourses(queryString)));
            return;
        }

        if (pathname === '/api/courses') {
            res.writeHead(200);
            res.end(JSON.stringify(getAllCourses()));
            return;
        }

        if (pathname.startsWith('/api/courses/')) {
            const id = pathname.slice('/api/courses/'.length);
            res.writeHead(200);
            res.end(JSON.stringify(getCourseById(id)));
            return;
        }

        // 404
        res.writeHead(404);
        res.end(JSON.stringify({
            success: false,
            message: 'Route not found',
        }));
        return;
    }

    // Method not allowed
    res.writeHead(405);
    res.end(JSON.stringify({
        success: false,
        message: 'Method not allowed',
    }));
});

const PORT = process.env.PORT || 3000;

server.listen(PORT, () => {
    console.log(`🚀 WHTECH Server running on http://localhost:${PORT}`);
    console.log(`📚 API Docs:`);
    console.log(`   GET  /api/courses/search?q=<query>&category=<category>&page=<page>&per_page=<per_page>`);
    console.log(`   GET  /api/courses - Get all courses`);
    console.log(`   GET  /api/courses/:id - Get single course`);
});
