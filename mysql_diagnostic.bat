@echo off
echo ========================================
echo MySQL XAMPP Diagnostic Tool
echo ========================================
echo.

echo [1] Checking if MySQL is running...
tasklist | findstr /I "mysqld.exe"
if %errorlevel% equ 0 (
    echo MySQL is RUNNING
) else (
    echo MySQL is NOT running
)
echo.

echo [2] Checking port 3306...
netstat -ano | findstr :3306
if %errorlevel% equ 0 (
    echo Port 3306 is IN USE
) else (
    echo Port 3306 is FREE
)
echo.

echo [3] Checking MySQL service...
sc query MySQL
echo.

echo [4] Last 20 lines of MySQL error log:
echo ----------------------------------------
if exist "C:\xampp\mysql\data\*.err" (
    for /f %%i in ('dir /b /od "C:\xampp\mysql\data\*.err"') do set ERRFILE=%%i
    powershell -Command "Get-Content 'C:\xampp\mysql\data\%ERRFILE%' -Tail 20"
) else (
    echo No error log found
)
echo.

echo ========================================
echo Diagnostic Complete
echo ========================================
pause
