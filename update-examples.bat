@echo off
REM Update examples from instructor's repository
REM Run this when your instructor announces new content

REM ============================================================
REM INSTRUCTOR: Replace this URL with your template repository
set UPSTREAM_URL=https://github.com/john-dempsey/web-development-template.git 
REM ============================================================

REM Check if upstream remote exists, add it if not
git remote | findstr /x "upstream" >nul
if %ERRORLEVEL% NEQ 0 (
    echo Adding instructor's repository as upstream remote...
    git remote add upstream %UPSTREAM_URL%
)

git fetch upstream
git merge upstream/main --allow-unrelated-histories --strategy=ours -m "Keep local changes, add new content"
git checkout upstream/main -- $(git diff --name-only --diff-filter=A HEAD..upstream/main)
git add .
git commit -m "Added new exercises from instructor"

if %ERRORLEVEL% EQU 0 (
    echo.
    echo Done! Your repository is now up to date.
) else (
    echo.
    echo There were merge conflicts. Ask your instructor for help.
)

pause
