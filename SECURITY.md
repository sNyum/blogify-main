# Security Policy

## 🔒 Supported Versions

We release patches for security vulnerabilities for the following versions:

| Version | Supported          |
| ------- | ------------------ |
| 2.x.x   | :white_check_mark: |
| 1.x.x   | :x:                |

## 🚨 Reporting a Vulnerability

We take the security of our software seriously. If you believe you have found a security vulnerability, please report it to us as described below.

### Where to Report

**Please do NOT report security vulnerabilities through public GitHub issues.**

Instead, please report them via email to:
- **Email**: bps5207@bps.go.id
- **Subject**: [SECURITY] Brief description of the issue

### What to Include

Please include the following information in your report:

1. **Type of issue** (e.g., SQL injection, XSS, authentication bypass)
2. **Full paths** of source file(s) related to the issue
3. **Location** of the affected source code (tag/branch/commit or direct URL)
4. **Step-by-step instructions** to reproduce the issue
5. **Proof-of-concept or exploit code** (if possible)
6. **Impact** of the issue, including how an attacker might exploit it

### What to Expect

- **Acknowledgment**: We will acknowledge receipt of your vulnerability report within 48 hours
- **Updates**: We will send you regular updates about our progress
- **Timeline**: We aim to resolve critical issues within 7 days
- **Credit**: If you wish, we will credit you in our security advisory

## 🛡️ Security Best Practices

### For Administrators

1. **Change Default Credentials**
   - Immediately change all default passwords after installation
   - Use strong, unique passwords for each account

2. **Environment Configuration**
   ```env
   # Never commit these to version control
   APP_KEY=                    # Generate with: php artisan key:generate
   DB_PASSWORD=                # Use strong password
   GEMINI_API_KEY=            # Keep secret
   BPS_API_KEY=               # Keep secret
   ```

3. **File Permissions**
   ```bash
   # Secure file permissions
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

4. **HTTPS Configuration**
   - Always use HTTPS in production
   - Configure SSL certificates properly
   - Set `APP_URL` to use `https://`

5. **Database Security**
   - Use separate database user with minimal privileges
   - Never use root database account
   - Enable MySQL strict mode

6. **Regular Updates**
   ```bash
   # Keep dependencies updated
   composer update
   npm update
   
   # Check for security advisories
   composer audit
   npm audit
   ```

### For Developers

1. **Input Validation**
   - Always validate and sanitize user input
   - Use Laravel's validation rules
   - Never trust client-side validation alone

2. **SQL Injection Prevention**
   - Use Eloquent ORM or Query Builder
   - Never concatenate SQL queries with user input
   - Use parameter binding for raw queries

3. **XSS Prevention**
   - Use `{{ }}` for output (auto-escaped)
   - Only use `{!! !!}` when absolutely necessary
   - Sanitize HTML input with HTMLPurifier

4. **CSRF Protection**
   - Always include `@csrf` in forms
   - Don't disable CSRF middleware
   - Use `csrf_token()` for AJAX requests

5. **Authentication & Authorization**
   - Use Laravel's built-in authentication
   - Implement proper authorization checks
   - Use Filament Shield for role-based access

6. **API Security**
   - Use API tokens (Sanctum)
   - Implement rate limiting
   - Validate all API inputs

7. **File Upload Security**
   ```php
   // Validate file types
   $request->validate([
       'file' => 'required|file|mimes:pdf,jpg,png|max:10240'
   ]);
   
   // Store in non-public directory
   $path = $request->file('file')->store('private');
   ```

8. **Sensitive Data**
   - Never log sensitive information
   - Use encryption for sensitive database fields
   - Implement proper session management

## 🔐 Security Features

### Built-in Security

- ✅ **CSRF Protection** - Enabled by default
- ✅ **XSS Protection** - Blade template escaping
- ✅ **SQL Injection Protection** - Eloquent ORM
- ✅ **Password Hashing** - Bcrypt/Argon2
- ✅ **Rate Limiting** - API throttling
- ✅ **Secure Headers** - Security middleware
- ✅ **Role-Based Access Control** - Filament Shield

### Recommended Additional Security

1. **Two-Factor Authentication (2FA)**
   - Consider implementing 2FA for admin accounts
   - Use packages like `pragmarx/google2fa-laravel`

2. **Security Headers**
   ```php
   // Add to middleware
   'Content-Security-Policy' => "default-src 'self'",
   'X-Frame-Options' => 'SAMEORIGIN',
   'X-Content-Type-Options' => 'nosniff',
   'Referrer-Policy' => 'strict-origin-when-cross-origin'
   ```

3. **Logging & Monitoring**
   - Enable application logging
   - Monitor for suspicious activities
   - Set up alerts for failed login attempts

4. **Backup Strategy**
   - Regular database backups
   - Secure backup storage
   - Test backup restoration

## 📋 Security Checklist

Before deploying to production:

- [ ] All default passwords changed
- [ ] `.env` file properly configured and secured
- [ ] HTTPS enabled with valid SSL certificate
- [ ] File permissions properly set
- [ ] Database user has minimal privileges
- [ ] All dependencies updated to latest secure versions
- [ ] Security headers configured
- [ ] Rate limiting enabled
- [ ] Error reporting disabled in production (`APP_DEBUG=false`)
- [ ] Backup system in place
- [ ] Monitoring and logging configured
- [ ] Security audit completed

## 🔍 Known Security Considerations

### API Keys
- Gemini API key is required for chatbot functionality
- BPS API key is required for real-time statistics
- Store these securely in `.env` file
- Never commit API keys to version control

### File Uploads
- File uploads are restricted by type and size
- Uploaded files are scanned for malicious content
- Files are stored outside the web root when possible

### WebSocket Security
- Laravel Reverb uses secure WebSocket connections
- Authentication required for private channels
- Message broadcasting is authorized per user

## 📞 Contact

For security-related questions or concerns:
- **Email**: bps5207@bps.go.id
- **Website**: https://batangharikab.bps.go.id

---

**Last Updated**: February 3, 2026
