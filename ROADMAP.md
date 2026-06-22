# Marbure Theme — Complete Development Roadmap

**Reference:** [Lagix Demo 01](https://lagix-demo.pbminfotech.com/demo-01) (Law Firm / Attorney)
**Stack:** WordPress 6.x · Underscores (_s) · Kirki · Elementor · SCSS · Vanilla JS

---

## Table of Contents

1. [Site & Page Architecture](#1-site--page-architecture)
2. [Header Structure](#2-header-structure)
3. [Footer Structure](#3-footer-structure)
4. [Custom Post Types & Taxonomies](#4-custom-post-types--taxonomies)
5. [Theme Options — Kirki Panels](#5-theme-options--kirki-panels--sections)
6. [Template File Structure](#6-template-file-structure)
7. [Widget Areas](#7-widget-areas-sidebars)
8. [Navigation Menus](#8-navigation-menus)
9. [Third-Party Libraries](#9-third-party-libraries)
10. [Elementor & Gutenberg Requirements](#10-elementor--gutenberg-requirements)
11. [SCSS Architecture](#11-scss-architecture)
12. [Performance Recommendations](#12-performance-recommendations)
13. [SEO & Schema](#13-seo--schema-recommendations)
14. [Development Phases](#14-development-phases)
15. [ThemeForest Compliance Checklist](#15-themeforest-compliance-checklist)

---

## 1. Site & Page Architecture

| Page | Template | Notes |
|---|---|---|
| Home (3 variants) | `page-templates/page-home-*.php` | Hero slider, all sections |
| About Us | `page-templates/page-about.php` | Metrics, pillars, team preview, awards |
| Practice Areas (archive) | `archive-marbure_service.php` | Filterable grid |
| Practice Area (single) | `single-marbure_service.php` | Sidebar with related services |
| Case Results (archive) | `archive-marbure_portfolio.php` | Isotope grid, category filter tabs |
| Case Result (single) | `single-marbure_portfolio.php` | Full case details |
| Our Team (archive) | `archive-marbure_team.php` | Grid with hover cards |
| Attorney (single) | `single-marbure_team.php` | Bio, credentials, contact form |
| Testimonials | `page-templates/page-testimonials.php` | Masonry or grid |
| FAQ | `page-templates/page-faq.php` | Accordion + Schema |
| Blog (archive) | `archive.php` | Left/right/no sidebar option |
| Blog (single) | `single.php` | Author box, related posts |
| Contact | `page-templates/page-contact.php` | Map + form |
| Full Width | `page-templates/page-fullwidth.php` | No sidebar, for Elementor |
| 404 | `404.php` | — |
| Search | `search.php` | — |

---

## 2. Header Structure

```
┌─────────────────────────────────────────────────────┐
│  TOP BAR (toggle on/off via Kirki)                  │
│  [Phone] [Email]              [FB] [X] [IG]         │
├─────────────────────────────────────────────────────┤
│  MAIN HEADER (sticky + shrink on scroll)            │
│  [LOGO]   [Nav: Home | Services | Portfolio | ...]  │
│           [🔍 Search]  [📞 Free Consultation CTA]   │
├─────────────────────────────────────────────────────┤
│  MEGA MENU DROPDOWN (on Services, Pages)            │
│  [ Thumbnail cards with section previews ]          │
├─────────────────────────────────────────────────────┤
│  MOBILE (< 992px): [LOGO] ─────────── [☰ Hamburger]│
│  → Off-canvas panel slides in from right            │
└─────────────────────────────────────────────────────┘
```

### Header Variants (Kirki toggle per page)

| Variant | Style |
|---|---|
| `header-default` | White background, dark nav links |
| `header-transparent` | Overlays hero image, white text |
| `header-centered` | Logo centered, navigation below |

---

## 3. Footer Structure

```
┌─────────────────────────────────────────────────────┐
│  PRE-FOOTER CTA BAND (optional, Kirki toggle)       │
│  "Ready to fight for your rights?" [Book a Call]    │
├──────────┬──────────┬──────────┬────────────────────┤
│ COLUMN 1 │ COLUMN 2 │ COLUMN 3 │ COLUMN 4           │
│ Logo     │ Quick    │ Practice │ Newsletter         │
│ About    │ Links    │ Areas    │ + Contact Info     │
│ Social   │          │          │                    │
├──────────┴──────────┴──────────┴────────────────────┤
│  BOTTOM BAR                                         │
│  © 2025 Marbure            [Privacy] [Terms] [Map]  │
└─────────────────────────────────────────────────────┘
```

---

## 4. Custom Post Types & Taxonomies

### Custom Post Types

| Post Type | Slug | Supports | Public Label |
|---|---|---|---|
| Practice Areas | `marbure_service` | title, editor, thumbnail, excerpt, page-attributes | Practice Area / Practice Areas |
| Case Results | `marbure_portfolio` | title, editor, thumbnail, excerpt | Case Result / Case Results |
| Attorneys | `marbure_team` | title, editor, thumbnail, excerpt | Attorney / Attorneys |
| Testimonials | `marbure_testimonial` | title, editor, thumbnail, custom-fields | Testimonial / Testimonials |
| FAQ Items | `marbure_faq` | title, editor | FAQ / FAQs |

### Taxonomies

| Taxonomy | Slug | Attached To | Hierarchical |
|---|---|---|---|
| Service Category | `service_cat` | `marbure_service` | Yes |
| Portfolio Category | `portfolio_cat` | `marbure_portfolio` | Yes |
| Team Department | `team_dept` | `marbure_team` | Yes |
| Testimonial Source | `testimonial_type` | `marbure_testimonial` | No |

### Custom Meta Fields (per CPT)

**`marbure_team`**
- `_team_position` — Job title / role
- `_team_phone` — Direct phone number
- `_team_email` — Email address
- `_team_bar_number` — Bar registration number
- `_team_linkedin`, `_team_facebook`, `_team_twitter` — Social URLs

**`marbure_service`**
- `_service_icon_class` — Font Awesome icon class
- `_service_tagline` — Short tagline (used on cards)
- `_service_featured` — Checkbox: show on homepage grid

**`marbure_portfolio`**
- `_portfolio_case_type` — Type of case
- `_portfolio_settlement` — Settlement value (e.g. $2.5M)
- `_portfolio_outcome` — Won / Settled / Dismissed
- `_portfolio_year` — Year of resolution

**`marbure_testimonial`**
- `_testimonial_rating` — Star rating 1–5
- `_testimonial_client_title` — Client's job title / description
- `_testimonial_source_url` — Link to original review

---

## 5. Theme Options — Kirki Panels & Sections

```
Panel: General Settings
  ├── Site Identity        → logo, logo-white (for transparent header),
  │                          favicon, tagline display on/off
  ├── Colors               → primary (#0A1E3F navy), secondary (#CF9776 gold),
  │                          accent, body-text, heading-text, bg
  ├── Preloader            → on/off, style (circle spinner / logo pulse)
  ├── Back to Top          → on/off, position (right/left), scroll offset
  └── Social Media         → facebook, twitter/x, instagram, linkedin, youtube

Panel: Header
  ├── Top Bar              → on/off, phone number, email, custom HTML
  ├── Main Header          → logo max-width, sticky on/off, shrink on scroll on/off
  ├── Transparent Header   → enable on front-page only / all pages / off
  └── CTA Button           → label text, URL, open in new tab, on/off

Panel: Page Header (Breadcrumb Band)
  ├── General              → on/off globally, breadcrumb separator character
  ├── Default Background   → image upload, overlay color + opacity (0–1)
  └── Title Style          → font size override, text alignment

Panel: Footer
  ├── Pre-footer CTA       → on/off, heading, subtext, button label, button URL
  ├── Footer Layout        → column count (1 / 2 / 3 / 4)
  ├── Footer Style         → background color, background image, text color
  └── Bottom Bar           → copyright text (supports {year} token), show/hide links

Panel: Typography
  ├── Body Font            → Google Font family, size (px), weight, line-height
  ├── Heading Font         → Google Font family, weight, h1–h6 individual sizes
  └── Navigation Font      → family, size, letter-spacing, text-transform

Panel: Blog
  ├── Archive Layout       → sidebar position (left / right / none), columns (2/3)
  ├── Single Layout        → sidebar position, featured image style (full/boxed)
  ├── Post Card            → excerpt length (words), show/hide: date, category, author
  └── Author Box           → show/hide on single posts

Panel: CPT Settings
  ├── Services             → archive columns (2/3/4), show excerpt on cards
  ├── Portfolio            → archive columns (2/3), enable Isotope filtering
  └── Team                 → archive columns (2/3/4), show social links on cards

Panel: Performance
  ├── Scripts              → defer non-critical JS on/off, preconnect Google Fonts on/off
  └── Images               → native lazy load on/off, output width/height attributes on/off
```

---

## 6. Template File Structure

```
marbure/
│
├── style.css                        ← Theme header + compiled CSS output
├── style-rtl.css                    ← Auto-generated RTL overrides
├── functions.php                    ← Lean bootstrap — only requires inc/bootstrap.php
├── index.php
├── header.php
├── footer.php
├── sidebar.php
├── single.php
├── page.php
├── archive.php
├── search.php
├── 404.php
├── comments.php
├── searchform.php
├── screenshot.png                   ← 1200×900px (ThemeForest requirement)
│
├── archive-marbure_service.php      ← Practice Areas archive
├── archive-marbure_portfolio.php    ← Case Results archive (with filter tabs)
├── archive-marbure_team.php         ← Attorneys archive
├── single-marbure_service.php       ← Single Practice Area
├── single-marbure_portfolio.php     ← Single Case Result
├── single-marbure_team.php          ← Single Attorney profile
│
├── page-templates/
│   ├── page-home.php                ← Homepage v1 (template comment header)
│   ├── page-home-v2.php
│   ├── page-home-v3.php
│   ├── page-about.php
│   ├── page-contact.php
│   ├── page-faq.php
│   ├── page-testimonials.php
│   └── page-fullwidth.php           ← No sidebar, full canvas for Elementor
│
├── template-parts/
│   ├── content.php                  ← Blog archive post loop
│   ├── content-none.php
│   ├── content-page.php
│   ├── content-search.php
│   ├── content-single.php
│   │
│   ├── header/
│   │   ├── top-bar.php              ← Phone, email, social icons row
│   │   ├── header-main.php          ← Logo + nav + CTA button
│   │   └── mobile-off-canvas.php    ← Hamburger + slide-in panel
│   │
│   ├── footer/
│   │   ├── pre-footer-cta.php       ← Full-width CTA band above footer
│   │   ├── footer-widgets.php       ← 4-column widget grid
│   │   └── footer-bottom.php        ← Copyright + nav links bar
│   │
│   ├── page-header/
│   │   └── breadcrumb-band.php      ← Page title + breadcrumb (all inner pages)
│   │
│   ├── sections/                    ← Reusable homepage sections
│   │   ├── hero-slider.php          ← Swiper full-width hero
│   │   ├── about-intro.php          ← Mission + metrics (stars, %, $)
│   │   ├── services-grid.php        ← Practice areas card grid
│   │   ├── stats-counter.php        ← Animated number counters
│   │   ├── portfolio-preview.php    ← Featured case results
│   │   ├── team-grid.php            ← Attorney cards
│   │   ├── testimonials-carousel.php← Swiper testimonials
│   │   ├── blog-grid.php            ← Latest posts
│   │   ├── cta-band.php             ← Mid-page consultation CTA
│   │   └── marquee-strip.php        ← Animated scrolling ticker
│   │
│   ├── service/
│   │   ├── card.php                 ← Archive card (icon, title, excerpt, link)
│   │   └── single-content.php       ← Single page body layout
│   │
│   ├── portfolio/
│   │   ├── card.php                 ← Archive card (image, category, outcome)
│   │   └── single-content.php
│   │
│   └── team/
│       ├── card.php                 ← Archive card (photo, name, role, socials)
│       └── single-content.php       ← Bio, credentials, sidebar contact
│
├── inc/
│   ├── bootstrap.php                ← Single file that require_onces everything below
│   ├── setup.php                    ← after_setup_theme: supports, image sizes
│   ├── enqueue.php                  ← All wp_enqueue_scripts / styles
│   ├── nav-menus.php                ← register_nav_menus (4 locations)
│   ├── sidebars.php                 ← register_sidebar (6 widget areas)
│   ├── cpts.php                     ← All register_post_type calls
│   ├── taxonomies.php               ← All register_taxonomy calls
│   ├── meta-boxes.php               ← Native WP meta boxes for CPT fields
│   ├── helpers.php                  ← Utility/helper functions
│   ├── template-tags.php            ← Custom template tag functions
│   ├── template-functions.php       ← Hook-based template modifications
│   ├── breadcrumb.php               ← Breadcrumb output function
│   ├── schema.php                   ← JSON-LD structured data output
│   ├── customizer.php               ← Core WP Customizer additional hooks
│   ├── custom-header.php
│   ├── jetpack.php
│   │
│   ├── class/
│   │   ├── class-marbure-walker-nav-menu.php  ← Mega menu HTML walker
│   │   └── class-marbure-breadcrumb.php       ← Breadcrumb generator class
│   │
│   ├── elementor/
│   │   ├── elementor-support.php              ← Location API, kit ID, conditions
│   │   └── widgets/
│   │       ├── widget-hero-slider.php
│   │       ├── widget-service-card.php
│   │       ├── widget-stat-counter.php
│   │       ├── widget-team-card.php
│   │       ├── widget-testimonial-carousel.php
│   │       ├── widget-case-card.php
│   │       ├── widget-faq-accordion.php
│   │       ├── widget-cta-band.php
│   │       └── widget-marquee-strip.php
│   │
│   └── kirki/
│       ├── bootstrap.php            ← (existing — loads all sections)
│       ├── config.php
│       ├── helpers.php
│       ├── panels.php
│       └── sections/
│           ├── general.php          ← (existing — expand)
│           ├── header.php           ← (existing — expand)
│           ├── footer.php           ← (existing — expand)
│           ├── typography.php       ← (existing — expand)
│           ├── blog.php             ← (existing — expand)
│           ├── performance.php      ← (existing — expand)
│           ├── social.php           ← NEW
│           ├── page-header.php      ← NEW
│           └── cpts.php             ← NEW
│
├── sass/
│   ├── style.scss                   ← Main entry: @forward all partials
│   │
│   ├── abstracts/
│   │   ├── _variables.scss          ← CSS custom props + SCSS vars
│   │   ├── _mixins.scss             ← respond-to(), flex-center(), etc.
│   │   ├── _functions.scss          ← rem(), em(), strip-unit()
│   │   └── _placeholders.scss       ← %clearfix, %visually-hidden
│   │
│   ├── base/
│   │   ├── _reset.scss              ← Normalize / modern reset
│   │   ├── _typography.scss         ← Body, headings, links base styles
│   │   ├── _utilities.scss          ← .u-text-center, .u-hidden, etc.
│   │   └── _animations.scss         ← @keyframes: fadeIn, slideUp, countUp
│   │
│   ├── layout/
│   │   ├── _grid.scss               ← .container, .row, col utilities
│   │   ├── _header.scss             ← Top bar, main header, sticky states
│   │   ├── _footer.scss             ← All 3 footer zones
│   │   ├── _sidebar.scss            ← Widget sidebar styles
│   │   └── _page-header.scss        ← Breadcrumb band + page title
│   │
│   ├── components/
│   │   ├── _buttons.scss            ← .btn-primary, .btn-outline, .btn-ghost
│   │   ├── _cards.scss              ← Generic card shell
│   │   ├── _navigation.scss         ← Desktop nav links, dropdowns
│   │   ├── _mega-menu.scss          ← Mega menu panel + thumbnail cards
│   │   ├── _mobile-menu.scss        ← Off-canvas overlay + slide panel
│   │   ├── _hero-slider.scss        ← Swiper hero, slide content, arrows
│   │   ├── _testimonials.scss       ← Testimonial cards + carousel
│   │   ├── _counters.scss           ← Stat counter blocks
│   │   ├── _team.scss               ← Team cards, hover reveal, socials
│   │   ├── _forms.scss              ← Inputs, labels, contact form
│   │   ├── _accordion.scss          ← FAQ accordion
│   │   ├── _pagination.scss         ← Numbered + prev/next
│   │   ├── _breadcrumb.scss
│   │   ├── _back-to-top.scss
│   │   ├── _preloader.scss
│   │   └── _marquee.scss            ← Infinite scrolling strip
│   │
│   ├── pages/
│   │   ├── _home.scss               ← Homepage-specific section spacing
│   │   ├── _about.scss
│   │   ├── _services.scss
│   │   ├── _portfolio.scss          ← Isotope grid + filter tabs
│   │   ├── _blog.scss
│   │   ├── _contact.scss            ← Map embed + form layout
│   │   └── _404.scss
│   │
│   ├── elementor/
│   │   └── _overrides.scss          ← Fix Elementor specificity conflicts
│   │
│   └── _rtl.scss                    ← RTL direction overrides
│
├── js/
│   ├── customizer.js                ← (existing)
│   ├── navigation.js                ← (existing)
│   └── src/                         ← Source files (concat/minify via wp-scripts)
│       ├── preloader.js
│       ├── sticky-header.js         ← classList add/remove on scroll
│       ├── mega-menu.js             ← Keyboard + mouse events
│       ├── mobile-menu.js           ← Off-canvas open/close/trap focus
│       ├── back-to-top.js           ← Show after 300px scroll, smooth scroll
│       ├── counter.js               ← IntersectionObserver + CountUp.js
│       ├── hero-slider.js           ← Swiper init + config
│       ├── testimonial-carousel.js  ← Swiper init + config
│       ├── portfolio-filter.js      ← Isotope init + filter button events
│       └── marquee.js               ← CSS animation fallback JS
│
├── assets/
│   ├── images/
│   │   ├── logo.png
│   │   ├── logo-white.png           ← Used on transparent/dark headers
│   │   └── placeholder/             ← Demo placeholder images
│   └── demo/
│       ├── demo-content.xml         ← WordPress export for demo import
│       └── customizer-settings.dat  ← Theme options export file
│
└── languages/
    ├── marbure.pot
    └── readme.txt
```

---

## 7. Widget Areas (Sidebars)

| ID | Name | Used In |
|---|---|---|
| `sidebar-main` | Main Sidebar | Blog archive + single |
| `sidebar-service` | Service Sidebar | Practice area single |
| `footer-col-1` | Footer Column 1 | Footer (logo + about + socials) |
| `footer-col-2` | Footer Column 2 | Footer (quick links) |
| `footer-col-3` | Footer Column 3 | Footer (practice areas) |
| `footer-col-4` | Footer Column 4 | Footer (newsletter + contact) |

---

## 8. Navigation Menus

| Location Slug | Label | Purpose |
|---|---|---|
| `primary` | Primary Menu | Main desktop navigation (mega menu enabled) |
| `mobile` | Mobile Menu | Off-canvas slide panel |
| `footer-links` | Footer Links | Bottom bar left side |
| `footer-services` | Footer Services | Footer column 3 quick list |

---

## 9. Third-Party Libraries

| Library | Version | Purpose | Load Strategy |
|---|---|---|---|
| [Swiper.js](https://swiperjs.com/) | 11.x | Hero slider, testimonials carousel | `defer` |
| [Isotope](https://isotope.metafizzy.co/) | 3.x | Portfolio grid filtering + sorting | `defer` |
| [CountUp.js](https://github.com/inorganik/countUp.js) | 2.x | Animated stat counters | `defer` |
| [GLightbox](https://biati-digital.github.io/glightbox/) | 3.x | Video lightbox popup | `defer` |
| [AOS](https://michalsnik.github.io/aos/) | 2.x | Scroll-triggered reveal animations | `defer` |
| Font Awesome | 6.x | Icons throughout UI | `async` |
| Google Fonts | — | Playfair Display (headings) + Inter (body) | `preconnect` + `display=swap` |

---

## 10. Elementor & Gutenberg Requirements

### Elementor

- **Minimum:** Elementor Free 3.x (Elementor Pro optional — used for Theme Builder)
- Register theme locations via `elementor/theme/register_locations` hook
- 9 custom Elementor widgets registered under **"Marbure"** category
- Elementor Kit import to sync colors + typography with Kirki values
- All page templates built as **Elementor Canvas** (no theme header/footer) or **Full Width**

### Custom Elementor Widgets

| Widget | Panel Controls |
|---|---|
| Hero Slider | Slides repeater, button text/URL, overlay color |
| Service Card | Icon, title, excerpt, link, layout style |
| Stat Counter | Number, suffix, label, icon, animation duration |
| Team Card | Photo, name, role, social URLs, hover style |
| Testimonial Carousel | Repeater: quote, name, title, rating, photo |
| Case Result Card | Image, category, outcome badge, settlement |
| FAQ Accordion | Repeater: question + answer, open first on/off |
| CTA Band | BG image/color, heading, text, primary + ghost buttons |
| Marquee Strip | Items repeater, speed, direction, pause on hover |

### Gutenberg

- `theme.json` — color palette, font sizes, spacing scale, border radius
- 8 block patterns (one per homepage section)
- Block styles: `outline` button variant, `bordered` card style
- `editor-style.css` — mirrors front-end typography inside block editor

---

## 11. SCSS Architecture

### CSS Custom Properties Strategy

All design tokens are declared as CSS custom properties so Kirki can override them at runtime via inline `<style>` in `<head>`:

```scss
/* sass/abstracts/_variables.scss */
:root {
  /* Colors */
  --color-primary:     #0A1E3F;   /* deep navy */
  --color-secondary:   #CF9776;   /* gold */
  --color-accent:      #1A3A6B;   /* mid navy */
  --color-text:        #3D3D3D;
  --color-heading:     #0A1E3F;
  --color-bg:          #FFFFFF;
  --color-bg-alt:      #F8F8F8;

  /* Typography */
  --font-heading:      'Playfair Display', Georgia, serif;
  --font-body:         'Inter', system-ui, sans-serif;
  --font-size-base:    16px;
  --line-height-base:  1.7;

  /* Layout */
  --container-width:   1200px;
  --gutter:            30px;

  /* Header */
  --header-height:     90px;
  --header-shrunk:     70px;
  --topbar-height:     44px;

  /* Misc */
  --radius:            4px;
  --radius-lg:         8px;
  --shadow:            0 4px 24px rgba(0,0,0,.08);
  --transition:        0.3s ease;
  --transition-slow:   0.6s ease;
}
```

### Breakpoints

| Name | Value | Usage |
|---|---|---|
| `xs` | 480px | Very small phones |
| `sm` | 576px | Small phones |
| `md` | 768px | Tablets portrait |
| `lg` | 992px | Tablets landscape / small desktop |
| `xl` | 1200px | Desktop |
| `xxl` | 1400px | Wide desktop |

### Naming Convention

**BEM** throughout: `.block__element--modifier`

Examples:
- `.site-header__topbar`
- `.service-card__icon--large`
- `.btn--outline`
- `.hero-slider__slide-title`

---

## 12. Performance Recommendations

| Area | Action |
|---|---|
| **Fonts** | `preconnect` to `fonts.googleapis.com` + `fonts.gstatic.com`; `font-display: swap` on all face declarations |
| **Images** | Native `loading="lazy"` on all non-LCP images; always output `width` + `height` to prevent CLS; register multiple `add_image_size()` to avoid oversized delivery |
| **Critical CSS** | Inline above-the-fold CSS (header + hero) via `wp_add_inline_style`; defer remaining stylesheet |
| **JavaScript** | All theme JS enqueued with `defer`; split into page-specific files — Isotope only loads on portfolio pages, Swiper only where sliders exist |
| **WP Queries** | CPT archive queries set `no_found_rows => true` on pages without pagination; `update_post_meta_cache => false` when meta not needed |
| **Kirki Caching** | All `get_theme_mod()` calls in template files wrapped in static-var helper to avoid repeated DB reads |
| **Third-party** | All vendor libs loaded conditionally; no global jQuery dependency — write vanilla JS |
| **Production** | Use `wp-scripts build` to minify JS; version assets with `filemtime()` during dev, fixed version string for releases |

---

## 13. SEO & Schema Recommendations

### JSON-LD Structured Data

| Schema Type | Output On |
|---|---|
| `LegalService` + `LocalBusiness` | Site-wide in `<head>` (from Kirki contact fields) |
| `Attorney` / `Person` | `single-marbure_team.php` |
| `Service` | `single-marbure_service.php` |
| `FAQPage` | `page-templates/page-faq.php` |
| `BreadcrumbList` | All inner pages |
| `Article` | `single.php` (blog) |
| `AggregateRating` + `Review` | Testimonials section / page |

### General SEO

- Semantic HTML5 landmarks: `<header>`, `<main>`, `<nav>`, `<aside>`, `<footer>`, `<article>`, `<section>`
- One `<h1>` per page; logical `<h2>` → `<h4>` hierarchy
- All images include `alt`, `width`, `height` attributes
- Open Graph + Twitter Card meta tags output via `wp_head` hook
- Canonical URLs via `rel="canonical"` in `<head>`
- Skip-to-content link for accessibility and crawlability
- Yoast SEO / RankMath compatible — no hardcoded `<title>` tags
- All CPTs set `public => true` and `has_archive => true` for sitemap inclusion

---

## 14. Development Phases

### Phase 1 — Foundation (Week 1)

- [ ] Refactor `functions.php` → modular `inc/bootstrap.php` system
- [ ] Create `inc/setup.php` with all theme supports + image sizes
- [ ] Create `inc/cpts.php` — register all 5 CPTs
- [ ] Create `inc/taxonomies.php` — register all 4 taxonomies
- [ ] Create `inc/meta-boxes.php` — all CPT custom fields
- [ ] Create `inc/nav-menus.php` — 4 menu locations
- [ ] Create `inc/sidebars.php` — 6 widget areas
- [ ] Expand all Kirki sections with full option fields
- [ ] Add `sections/social.php`, `sections/page-header.php`, `sections/cpts.php` to Kirki
- [ ] Set up SCSS folder structure + `sass/style.scss` entry
- [ ] Verify `npm run watch` compiles correctly

### Phase 2 — Core Layout (Week 2)

- [ ] Build `template-parts/header/top-bar.php`
- [ ] Build `template-parts/header/header-main.php` (logo + mega menu nav + CTA)
- [ ] Build `template-parts/header/mobile-off-canvas.php`
- [ ] Build `header.php` to conditionally include above partials
- [ ] Build `template-parts/footer/pre-footer-cta.php`
- [ ] Build `template-parts/footer/footer-widgets.php`
- [ ] Build `template-parts/footer/footer-bottom.php`
- [ ] Build `template-parts/page-header/breadcrumb-band.php`
- [ ] Implement sticky header + shrink effect (`js/src/sticky-header.js`)
- [ ] Implement off-canvas mobile menu (`js/src/mobile-menu.js`)
- [ ] SCSS: `_header.scss`, `_footer.scss`, `_navigation.scss`, `_mega-menu.scss`, `_mobile-menu.scss`

### Phase 3 — Homepage (Week 3)

- [ ] `template-parts/sections/hero-slider.php` + Swiper JS + SCSS
- [ ] `template-parts/sections/about-intro.php`
- [ ] `template-parts/sections/services-grid.php`
- [ ] `template-parts/sections/stats-counter.php` + CountUp.js
- [ ] `template-parts/sections/portfolio-preview.php`
- [ ] `template-parts/sections/team-grid.php`
- [ ] `template-parts/sections/testimonials-carousel.php` + Swiper
- [ ] `template-parts/sections/blog-grid.php`
- [ ] `template-parts/sections/cta-band.php`
- [ ] `template-parts/sections/marquee-strip.php`
- [ ] `page-templates/page-home.php` assembling all sections
- [ ] AOS scroll animations wired to all sections

### Phase 4 — Inner Pages (Week 4)

- [ ] `archive-marbure_service.php` + `template-parts/service/card.php`
- [ ] `single-marbure_service.php` + `template-parts/service/single-content.php`
- [ ] `archive-marbure_portfolio.php` + Isotope filter + `template-parts/portfolio/card.php`
- [ ] `single-marbure_portfolio.php`
- [ ] `archive-marbure_team.php` + `template-parts/team/card.php`
- [ ] `single-marbure_team.php`
- [ ] `page-templates/page-about.php`
- [ ] `page-templates/page-contact.php` (map embed + CF7/WPForms form)
- [ ] `page-templates/page-faq.php` + FAQPage schema
- [ ] `archive.php` + `single.php` blog with author box + related posts
- [ ] `404.php`
- [ ] `search.php`

### Phase 5 — Elementor Widgets (Week 5)

- [ ] `inc/elementor/elementor-support.php` (location API, widget registration)
- [ ] Build all 9 custom Elementor widgets
- [ ] Create Elementor Kit with theme colors + fonts
- [ ] `theme.json` for Gutenberg
- [ ] 8 block patterns (one per homepage section)
- [ ] `editor-style.css`

### Phase 6 — ThemeForest Polish (Week 6)

- [ ] `_rtl.scss` + generate `style-rtl.css`
- [ ] WCAG 2.1 AA audit (focus states, color contrast, ARIA labels)
- [ ] `inc/schema.php` — all JSON-LD outputs
- [ ] Open Graph + Twitter Card meta
- [ ] Demo content XML (`assets/demo/demo-content.xml`)
- [ ] Customizer settings export (`assets/demo/customizer-settings.dat`)
- [ ] Child theme folder + `style.css` + `functions.php`
- [ ] `screenshot.png` at 1200×900px
- [ ] Run Theme Check plugin — fix all errors/warnings
- [ ] HTML documentation

---

## 15. ThemeForest Compliance Checklist

### Code Quality
- [ ] GPL 2.0+ license declared in `style.css`
- [ ] All strings wrapped in `__()`, `esc_html__()`, `esc_attr__()`
- [ ] No PHP errors/warnings with `WP_DEBUG true`
- [ ] No direct `$_GET`/`$_POST` without sanitization
- [ ] Passes [Theme Check plugin](https://wordpress.org/plugins/theme-check/) with zero errors

### Compatibility
- [ ] WordPress 6.5+ tested
- [ ] PHP 8.1+ tested
- [ ] Elementor 3.x compatible
- [ ] WooCommerce basic compatibility (if shop page used)
- [ ] Jetpack compatible

### Accessibility
- [ ] WCAG 2.1 AA color contrast (4.5:1 normal, 3:1 large text)
- [ ] All interactive elements have visible focus states
- [ ] Skip-to-content link present
- [ ] ARIA labels on icon-only buttons
- [ ] Keyboard navigable mega menu + mobile off-canvas

### Internationalisation
- [ ] `.pot` file up-to-date with all translatable strings
- [ ] RTL stylesheet (`style-rtl.css`)
- [ ] `load_theme_textdomain()` called correctly

### Packaging
- [ ] Child theme included in ZIP
- [ ] Demo content XML included
- [ ] Customizer export `.dat` included
- [ ] One-click demo importer (via `wp-cli` instructions or plugin)
- [ ] Screenshot at exactly **1200×900px**
- [ ] HTML documentation (setup, customizer options, CPT usage, FAQ)

---

*Ready to start? Say **"Start Phase 1"** to begin coding the foundation.*
