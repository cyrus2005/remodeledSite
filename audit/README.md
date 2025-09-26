# Cyrus Wilburn Audit Website

This is the audit section of the Cyrus Wilburn website, designed to be accessible at `cyruswilburn.dev/audit`.

## File Structure

```
audit/
├── index.html          # Main audit funnel page (cyruswilburn.dev/audit)
├── quiz.html           # 30-second website audit quiz
├── form.html           # Full website audit form
├── css/
│   └── remixicon.css   # Remix Icons CSS
├── fonts/
│   ├── inter.css       # Inter font definitions
│   ├── remixicon.woff  # Remix Icons font (WOFF)
│   └── remixicon.woff2 # Remix Icons font (WOFF2)
└── media/
    ├── me/
    │   └── personalImage.png
    ├── portfolioEx/    # Portfolio examples (not used)
    └── sitePhotos/
        └── backgroundimagehero.jpg
```

## How It Works

- **`cyruswilburn.dev/audit`** → Shows `index.html` (main audit funnel)
- **`cyruswilburn.dev/audit/quiz`** → Shows `quiz.html` (30-second quiz)
- **`cyruswilburn.dev/audit/form`** → Shows `form.html` (full audit form)

## Deployment

To deploy this to your website:

1. Upload the entire `audit/` folder to your web server
2. Place it in your website's root directory
3. The audit section will be accessible at `cyruswilburn.dev/audit`

## Features

- ✅ Fully self-contained (except Tailwind CDN)
- ✅ Local fonts and icons
- ✅ Responsive design
- ✅ Navigation between all pages
- ✅ Professional audit funnel flow
- ✅ Lead capture forms

## External Dependencies

- Tailwind CSS (via CDN) - Required for styling
- All other resources are local
