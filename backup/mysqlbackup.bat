@echo off
setlocal

:: === Konfigurasi ===
set "BACKUP_DIR=D:\laragon\www\MakanApaYa\backup"
set "MYSQL_BIN=D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe"
set "DB_USER=adm_backup"
set "DB_PASS=admin123"
set "DB_NAME=MakanApaYa"

:: === Generate timestamp aman ===
for /f %%i in ('powershell -command "Get-Date -Format \"yyyy-MM-dd_HHmmss\""') do set TIMESTAMP=%%i
set "OUTPUT_FILE=%BACKUP_DIR%\%DB_NAME%_backup_%TIMESTAMP%.sql"

:: === Pastikan folder backup ada ===
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: === Jalankan mysqldump langsung ke file ===
"%MYSQL_BIN%" -u %DB_USER% -p%DB_PASS% %DB_NAME% --result-file="%OUTPUT_FILE%"

:: === Cek hasil ===
if %ERRORLEVEL% EQU 0 (
  echo Backup berhasil: %OUTPUT_FILE%
) else (
  echo Gagal melakukan backup!
)

pause
endlocal
