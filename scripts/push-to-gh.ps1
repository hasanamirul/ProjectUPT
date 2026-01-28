param(
    [string]$Message = "Prepare repo for WHTECH_2026",
    [switch]$UseEnvToken
)

# Ensure script is run from repository root
$RepoPath = (Get-Location).Path
Write-Host "Repository path: $RepoPath"

# Check for git
if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
    Write-Error "Git is not installed or not in PATH. Install Git for Windows and re-run this script."
    exit 1
}

# Configure user (from request)
git config user.name "seutaskatamu-cloud"
git config user.email "seutaskatamu@gmail.com"

# Initialize repo if needed




















































Write-Host "Done. If push failed, paste the output here and I'll help troubleshoot."}    git push -u origin main    Write-Host "No token provided. Will attempt interactive push (Git may prompt for credentials)."} else {    $pat = $null    # Clear sensitive variable    git push $pushUrl -u origin main    Write-Host "Pushing to remote (using token from env/prompt)..."    $pushUrl = "https://seutaskatamu-cloud:$escPat@github.com/seutaskatamu-cloud/WHTECH_2026.git"    $escPat = [System.Uri]::EscapeDataString($pat)    # Escape token for use in URL and push directly    }        $pat = $env:GITHUB_PAT    } else {        [System.Runtime.InteropServices.Marshal]::ZeroFreeBSTR($ptr)        $pat = [System.Runtime.InteropServices.Marshal]::PtrToStringBSTR($ptr)        $ptr = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure)        $secure = Read-Host "Enter GitHub Personal Access Token (PAT)" -AsSecureString        Write-Host "No GITHUB_PAT environment variable found; prompting for token (input hidden)."    if (-not $env:GITHUB_PAT) {if ($UseEnvToken.IsPresent -or $env:GITHUB_PAT) {# Push using PAT from environment variable or prompt (secure)Write-Host "Added remote origin -> $remoteUrl"git remote add origin $remoteUrl}    git remote remove origin    Write-Host "Removing existing 'origin' remote"if (git remote get-url origin 2>$null) {$remoteUrl = "https://github.com/seutaskatamu-cloud/WHTECH_2026.git"# Configure origin remote (HTTPS)# Ensure branch is main
ngit branch -M main 2>$null}    Write-Host "Commit successful."} else {    Write-Host "Commit returned non-zero exit code. Message: $commitResult"if ($LASTEXITCODE -ne 0) {$commitResult = git commit -m $Message 2>&1Write-Host "Committing..."git add -A# Add and commit
nWrite-Host "Staging files..."}    git init    Write-Host "Initializing new git repository..."if (-not (Test-Path (Join-Path $RepoPath ".git"))) {