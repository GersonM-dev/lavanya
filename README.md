## ⚙️ Setup

1. **Database:**  
    Uses SQLite by default. For MySQL, update `.env` and run:
    ```bash
    php artisan migrate
    ```
2. **Create Admin User:**  
    ```bash
    php artisan make:filament-user
    ```
3. **Assign Super Admin:**  
    ```bash
    php artisan shield:super-admin --user=1 --panel=admin
    ```
4. **Generate Permissions:**  
    ```bash
    php artisan shield:generate --all --ignore-existing-policies --panel=admin
    ```

## 🌟 Plugins

- [Breezy](https://filamentphp.com/plugins/jeffgreco-breezy): Profile page
- [Themes](https://filamentphp.com/plugins/hasnayeen-themes): Theme support
- [Shield](https://filamentphp.com/plugins/bezhansalleh-shield): Access management
- [Settings](https://filamentphp.com/plugins/outerweb-settings): Settings integration
- [Backgrounds](https://filamentphp.com/plugins/swisnl-backgrounds): Auth page backgrounds
- [Logger](https://filamentphp.com/plugins/z3d0x-logger): Activity logger

## 🧑‍💻 Dev Tools

- [Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Larastan](https://github.com/larastan/larastan)
- **Laravel Pint** for code style

Update model docs and format code:

```bash
php artisan ide-helper:models -W && ./vendor/bin/pint app
```

Run tests and checks:

```bash
composer check
```

## 📜 License

MIT License.

## 💡 Contributing

Contributions welcome! Open issues or PRs.

**Happy Coding with Laravel & Filament! 🎉**
