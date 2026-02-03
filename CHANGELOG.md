# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned
- Multi-language support (English, Indonesian)
- Advanced data visualization with interactive filters
- Export data analysis to Excel format
- Mobile app for field data collection
- Integration with more BPS APIs

## [2.0.0] - 2026-02-03

### Added
- 🤖 **AI Chatbot Integration** with Google Gemini API
  - Context-aware responses about BPS Batang Hari data
  - Integration with BPS Web API for real-time statistics
  - User feedback system for chatbot improvement
  - Persistent conversation sessions
- 📊 **Susenas Dashboard** for advanced data analysis
  - SPSS (.sav) file upload and parsing
  - PDF context extraction for variable metadata
  - Statistical analysis (frequency, crosstab, descriptive)
  - Interactive data visualization with Chart.js
  - Export analysis results to PDF
- 🔍 **KBLI Search Service** for business classification lookup
- 💬 **Live Chat System** with Laravel Reverb
  - Real-time messaging between users and BPS staff
  - WebSocket-based broadcasting
  - Chat moderation panel for staff
  - Message history and notifications
- 📝 **Data Request System**
  - Online form submission with file upload
  - Request tracking and status updates
  - Email notifications for applicants
  - Approval workflow for BPS staff
- 🔐 **Multi-role Authentication**
  - Admin, BPS Staff, and External User roles
  - Role-based access control with Filament Shield
  - User profile management
- 📰 **Content Management**
  - News publication with rich text editor
  - Document library management
  - Photo gallery
  - Sectoral information pages

### Changed
- Upgraded to Laravel 12
- Migrated to Filament v4
- Updated to Tailwind CSS 4
- Improved UI/UX with modern design patterns
- Enhanced security with Sanctum authentication

### Fixed
- File upload size limitations
- Real-time notification delivery
- Database query optimization
- Mobile responsiveness issues

## [1.0.0] - 2025-12-15

### Added
- Initial release
- Basic admin panel with Filament
- User authentication
- News management
- Document library
- Basic statistics display

---

## Version Numbering

- **Major version** (X.0.0): Breaking changes or major feature additions
- **Minor version** (0.X.0): New features, backward compatible
- **Patch version** (0.0.X): Bug fixes and minor improvements

## Support

For questions about changes, please:
- Check the [README](README.md) for updated documentation
- Open an issue on GitHub
- Contact the development team

---

**Note**: Dates are in YYYY-MM-DD format
