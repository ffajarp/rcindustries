@echo off
cd /d "c:\Users\obrigado\Desktop\AC\rccloth"
php artisan db:seed --class=OrderSeeder
pause
