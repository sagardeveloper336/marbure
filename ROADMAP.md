# Marbure Theme — Complete Development Roadmap
# Tiles & Flooring WordPress Theme for ThemeForest

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
| Home (3 variants) | `page-templates/page-home-*.php` | Hero slider, collections, stats, projects, testimonials |
| About Us | `page-templates/page-about.php` | Story, team, certifications, showroom |
| Products / Collections (archive) | `archive-marbure_product.php` | Grid with filter by taxonomy |
| Product / Collection (single) | `single-marbure_product.php` | Gallery, specs, related products |
| Projects (archive) | `archive-marbure_project.php` | Isotope grid, category filter |
| Project (single) | `single-marbure_project.php` | Full project details, tile used |
| Services | `page-templates/page-services.php` | Installation, consultation, supply |
| Gallery | `page-templates/page-gallery.php` | Masonry / filterable lightbox grid |
| Testimonials | `page-templates/page-testimonials.php` | Grid or masonry |
| FAQ | `page-templates/page-faq.php` | Accordion + Schema |
| Get a Quote | `page-templates/page-quote.php` | Quote request form |
| Blog (archive) | `archive.php` | Left/right/no sidebar |
| Blog (single) | `single.php` | Author box, related posts |
| Contact | `page-templates/page-contact.php` | Map + form + showroom info |
| Full Width | `page-templates/page-fullwidth.php` | No sidebar, for Elementor |
| 404 | `404.php` | — |
| Search | `search.php` | — |

---

## 2. Header Structure

```
┌─────────────────────────────────────────────────────┐
│  TOP BAR (toggle on/off via Kirki)                  │
│  [Phone] [Email] [Showroom Hours]    [FB] [IG] [PT] │
├─────────────────────────────────────────────────────┤
│  MAIN HEADER (sticky + shrink on scroll)            │
│  [LOGO]   [Nav: Home | Products | Projects | ...]   │
│           [🔍 Search]  [Get a Quote CTA]            │
├─────────────────────────────────────────────────────┤
│  MEGA MENU DROPDOWN (on Products, Projects)         │
│  [ Thumbnail cards with category previews ]         │
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
│  "Transform Your Space Today" [Get a Free Quote]    │
├──────────┬──────────┬──────────┬────────────────────┤
│ COLUMN 1 │ COLUMN 2 │ COLUMN 3 │ COLUMN 4           │
│ Logo     │ Quick    │ Products │ Newsletter         │
│ About    │ Links    │ / Pages  │ + Contact Info     │
│ Social   │          │          │                    │
├──────────┴──────────┴──────────┴────────────────────┤
│  BOTTOM BAR                                         │
│  © 2025 Marbure            [Privacy] [Terms] [Map]  │
└─────────────────────────────────────────────────────┘
```

---

## 4. Custom Post Types & Taxonomies

> **All CPTs and taxonomies are registered in the `pt-theme-addon` plugin** — not in the theme itself. The theme templates reference them universally.

### Custom Post Types

| Post Type | Slug | Supports | Public Label |
|---|---|---|---|
| Products / Collections | `marbure_product` | title, editor, thumbnail, excerpt, page-attributes | Product / Products |
| Projects | `marbure_project` | title, editor, thumbnail, excerpt, gallery | Project / Projects |
| Testimonials | `marbure_testimonial` | title, editor, thumbnail, custom-fields | Testimonial / Testimonials |
| FAQ Items | `marbure_faq` | title, editor | FAQ / FAQs |

### Taxonomies

| Taxonomy | Slug | Attached To | Hierarchical |
|---|---|---|---|
| Product Category | `product_cat` | `marbure_product` | Yes |
| Product Material | `product_material` | `marbure_product` | No |
| Product Finish | `product_finish` | `marbure_product` | No |
| Project Category | `project_cat` | `marbure_project` | Yes |
| Project Type | `project_type` | `marbure_project` | No |

### Custom Meta Fields (per CPT)

**`marbure_product`**
- `_product_size` — Tile size (e.g. 600×600mm)
- `_product_material` — Material type (free text fallback)
- `_product_finish` — Finish type (e.g. Matte, Glossy, Satin)
- `_product_thickness` — Thickness in mm
- `_product_color_family` — Primary colour family
- `_product_usage` — Usage (Floor / Wall / Both / Outdoor)
- `_product_price_range` — Price range label (e.g. $$, $$$)
- `_product_datasheet_url` — Link to PDF datasheet

**`marbure_project`**
- `_project_location` — City / region
- `_project_type` — Residential / Commercial / Hospitality
- `_project_area` — Area covered (e.g. 450 sqm)
- `_project_products_used` — Comma-separated product names
- `_project_completion_year` — Year completed
- `_project_client` — Client name (optional)

**`marbure_testimonial`**
- `_testimonial_rating` — Star rating 1–5
- `_testimonial_client_title` — Client designation / project type
- `_testimonial_source_url` — Link to original review

---

## 5. Theme Options — Kirki Panels & Sections

```
Panel: General Settings
  ├── Site Identity        → logo, logo-white (transparent header),
  │                          favicon, tagline on/off
  ├── Colors               → primary, secondary, accent,
  │                          body-text, heading-text, bg, bg-alt
  ├── Preloader            → on/off, style (spinner / logo pulse)
  ├── Back to Top          → on/off, scroll offset
  └── Social Media         → facebook, instagram, pinterest,
                             houzz, youtube, linkedin

Panel: Header
  ├── Top Bar              → on/off, phone, email, showroom hours text
  ├── Main Header          → logo max-width, sticky on/off, shrink on scroll
  ├── Transparent Header   → front-page only / all pages / off
  └── CTA Button           → label, URL, open in new tab, on/off

Panel: Page Header (Breadcrumb Band)
  ├── General              → on/off globally, separator character
  ├── Default Background   → image upload, overlay color + opacity
  └── Title Style          → font size override, text alignment

Panel: Footer
  ├── Pre-footer CTA       → on/off, heading, subtext, button label, URL
  ├── Footer Layout        → column count (1 / 2 / 3 / 4)
  ├── Footer Style         → bg color, bg image, text color
  └── Bottom Bar           → copyright text ({year} token), show/hide links

Panel: Typography
  ├── Body Font            → Google Font family, size, weight, line-height
  ├── Heading Font         → Google Font family, weight, h1–h6 sizes
  └── Navigation Font      → family, size, letter-spacing, text-transform

Panel: Blog
  ├── Archive Layout       → sidebar position (left / right / none), columns
  ├── Single Layout        → sidebar position, featured image style
  ├── Post Card            → excerpt length, show/hide: date, category, author
  └── Author Box           → show/hide on single posts

Panel: CPT Settings
  ├── Products             → archive columns (2/3/4), show meta on cards,
  │                          enable filter bar on/off
  ├── Projects             → archive columns (2/3), enable Isotope filtering
  └── General CPT          → show excerpt on archive cards (on/off)

Panel: Performance
  ├── Scripts              → defer non-critical JS, preconnect Google Fonts
  └── Images               → native lazy load, output width/height attributes
```

---

## 6. Template File Structure

```
marbure/
│
├── style.css
├── style-rtl.css
├── functions.php
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
├── screenshot.png                   ← 1200×900px
├── theme.json
├── editor-style.css
│
├── archive-marbure_product.php      ← Products archive (filter bar + grid)
├── archive-marbure_project.php      ← Projects archive (Isotope grid)
├── single-marbure_product.php       ← Single product / collection
├── single-marbure_project.php       ← Single project
│
├── page-templates/
│   ├── page-home.php
│   ├── page-home-v2.php
│   ├── page-home-v3.php
│   ├── page-about.php
│   ├── page-services.php
│   ├── page-gallery.php
│   ├── page-testimonials.php
│   ├── page-faq.php
│   ├── page-quote.php
│   ├── page-contact.php
│   └── page-fullwidth.php
│
├── template-parts/
│   ├── content.php
│   ├── content-none.php
│   ├── content-page.php
│   ├── content-search.php
│   ├── content-single.php
│   ├── content-product.php          ← Product archive card
│   ├── content-project.php          ← Project archive card
│   │
│   ├── header/
│   │   ├── top-bar.php
│   │   ├── header-main.php
│   │   └── mobile-off-canvas.php
│   │
│   ├── footer/
│   │   ├── pre-footer-cta.php
│   │   ├── footer-widgets.php
│   │   └── footer-bottom.php
│   │
│   ├── page-header/
│   │   └── breadcrumb-band.php
│   │
│   └── sections/                    ← Homepage sections
│       ├── hero-slider.php
│       ├── featured-collections.php
│       ├── why-choose-us.php
│       ├── stats-counter.php
│       ├── projects-preview.php
│       ├── services-overview.php
│       ├── testimonials-carousel.php
│       ├── blog-grid.php
│       ├── cta-band.php
│       └── marquee-strip.php        ← Brand / material logos ticker
│
├── inc/
│   ├── bootstrap.php
│   ├── setup.php
│   ├── enqueue.php
│   ├── nav-menus.php
│   ├── sidebars.php
│   ├── cpts.php                     ← Stub (CPTs in pt-theme-addon)
│   ├── taxonomies.php               ← Stub (taxonomies in pt-theme-addon)
│   ├── meta-boxes.php
│   ├── helpers.php
│   ├── template-tags.php
│   ├── template-functions.php
│   ├── breadcrumb.php
│   ├── schema.php
│   ├── og-meta.php
│   ├── customizer.php
│   ├── jetpack.php
│   │
│   ├── class/
│   │   ├── class-marbure-walker-nav-menu.php
│   │   └── class-marbure-breadcrumb.php
│   │
│   ├── elementor/
│   │   ├── elementor-support.php
│   │   └── widgets/
│   │       ├── widget-hero-slider.php
│   │       ├── widget-product-card.php
│   │       ├── widget-project-card.php
│   │       ├── widget-stat-counter.php
│   │       ├── widget-testimonial-carousel.php
│   │       ├── widget-faq-accordion.php
│   │       ├── widget-cta-band.php
│   │       ├── widget-gallery-grid.php
│   │       └── widget-marquee-strip.php
│   │
│   └── kirki/
│       ├── bootstrap.php
│       ├── config.php
│       ├── helpers.php
│       ├── panels.php
│       └── sections/
│           ├── general.php
│           ├── header.php
│           ├── footer.php
│           ├── typography.php
│           ├── blog.php
│           ├── performance.php
│           ├── social.php
│           ├── page-header.php
│           └── cpts.php
│
├── sass/                            ← Full SCSS architecture (unchanged)
├── js/
│   └── src/
│       ├── preloader.js
│       ├── sticky-header.js
│       ├── mega-menu.js
│       ├── mobile-menu.js
│       ├── back-to-top.js
│       ├── counter.js
│       ├── hero-slider.js
│       ├── testimonial-carousel.js
│       ├── portfolio-filter.js      ← Reused for projects Isotope
│       ├── gallery-filter.js        ← Gallery page lightbox + filter
│       └── marquee.js
│
├── assets/
│   ├── images/
│   │   ├── logo.png
│   │   └── logo-white.png
│   └── demo/
│       ├── demo-content.xml
│       └── customizer-settings.dat
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
| `sidebar-product` | Product Sidebar | Product archive / single (filter widget) |
| `footer-col-1` | Footer Column 1 | Footer logo + about + socials |
| `footer-col-2` | Footer Column 2 | Footer quick links |
| `footer-col-3` | Footer Column 3 | Footer products / pages |
| `footer-col-4` | Footer Column 4 | Footer newsletter + contact |

---

## 8. Navigation Menus

| Location Slug | Label | Purpose |
|---|---|---|
| `primary` | Primary Menu | Main desktop navigation (mega menu) |
| `mobile` | Mobile Menu | Off-canvas slide panel |
| `footer-links` | Footer Links | Bottom bar |
| `footer-products` | Footer Products | Footer column 3 quick list |

---

## 9. Third-Party Libraries

| Library | Version | Purpose | Load Strategy |
|---|---|---|---|
| [Swiper.js](https://swiperjs.com/) | 11.x | Hero slider, testimonials carousel | `defer` |
| [Isotope](https://isotope.metafizzy.co/) | 3.x | Projects grid filtering | `defer` |
| [GLightbox](https://biati-digital.github.io/glightbox/) | 3.x | Gallery lightbox | `defer` |
| [AOS](https://michalsnik.github.io/aos/) | 2.x | Scroll-triggered reveal animations | `defer` |
| [CountUp.js](https://github.com/inorganik/countUp.js) | 2.x | Animated stat counters | `defer` |
| Font Awesome | 6.x | Icons throughout UI | `async` |
| Google Fonts | — | Heading + body fonts | `preconnect` + `display=swap` |

---

## 10. Elementor & Gutenberg Requirements

### Custom Elementor Widgets

| Widget | Panel Controls |
|---|---|
| Hero Slider | Slides repeater, button text/URL, overlay color |
| Product Card | Image, title, meta (size, material, finish), link, layout style |
| Project Card | Image, location, type, area covered, hover style |
| Stat Counter | Number, suffix, label, icon, animation duration |
| Testimonial Carousel | Repeater: quote, name, title, rating, photo |
| FAQ Accordion | Repeater: question + answer, open first on/off |
| CTA Band | BG image/color, heading, text, primary + ghost buttons |
| Gallery Grid | Images repeater, columns, lightbox on/off, filter on/off |
| Marquee Strip | Items repeater (logos/text), speed, direction, pause on hover |

### Gutenberg

- `theme.json` — color palette, font sizes, spacing scale
- Block patterns (one per homepage section)
- `editor-style.css`

---

## 11. SCSS Architecture

### CSS Custom Properties

```scss
:root {
  --color-primary:     #1A1A2E;   /* deep charcoal / dark navy */
  --color-secondary:   #C8A96E;   /* warm gold */
  --color-accent:      #E8E0D5;   /* warm off-white / stone */
  --color-text:        #4A4A4A;
  --color-heading:     #1A1A2E;
  --color-bg:          #FFFFFF;
  --color-bg-alt:      #F7F5F2;   /* warm stone background */

  --font-heading:      'Cormorant Garamond', Georgia, serif;
  --font-body:         'Jost', system-ui, sans-serif;
  --font-size-base:    16px;
  --line-height-base:  1.75;

  --container-width:   1200px;
  --gutter:            30px;
  --section-padding-y: 100px;

  --header-height:     90px;
  --header-shrunk:     70px;
  --topbar-height:     44px;

  --radius:            2px;        /* tiles theme: sharper corners */
  --radius-lg:         4px;
  --shadow:            0 4px 24px rgba(0,0,0,.07);
  --transition:        0.3s ease;
}
```

### Breakpoints

| Name | Value |
|---|---|
| `xs` | 480px |
| `sm` | 576px |
| `md` | 768px |
| `lg` | 992px |
| `xl` | 1200px |
| `xxl` | 1400px |

**Naming:** BEM throughout — `.block__element--modifier`

---

## 12. Performance Recommendations

| Area | Action |
|---|---|
| **Fonts** | `preconnect` to Google Fonts; `font-display: swap` |
| **Images** | Native `loading="lazy"` on non-hero images; `width` + `height` always output; `srcset` via `wp_get_attachment_image` |
| **Gallery** | GLightbox loaded only on gallery / project single templates |
| **Isotope** | Loaded only on project archive pages |
| **Critical CSS** | Inline above-fold CSS (header + hero) via `wp_add_inline_style` |
| **JavaScript** | All JS enqueued with `defer`; split per page type |
| **Kirki** | All `get_theme_mod()` calls wrapped in static-var `marbure_get_option()` helper |

---

## 13. SEO & Schema Recommendations

| Schema Type | Output On |
|---|---|
| `LocalBusiness` + `HomeAndConstructionBusiness` | Site-wide `<head>` |
| `Product` | `single-marbure_product.php` |
| `CreativeWork` / `Project` | `single-marbure_project.php` |
| `FAQPage` | `page-templates/page-faq.php` |
| `BreadcrumbList` | All inner pages |
| `Article` | `single.php` (blog) |
| `AggregateRating` + `Review` | Testimonials page |

---

## 14. Development Phases

### Phase 1 — Foundation (Week 1) ✅ COMPLETE

> CPTs, taxonomies, and meta-boxes are in the `pt-theme-addon` plugin.

- [x] Modular `inc/bootstrap.php` system
- [x] `inc/setup.php` — theme supports + image sizes
- [x] `inc/nav-menus.php` — 4 menu locations
- [x] `inc/sidebars.php` — 6 widget areas
- [x] All Kirki sections with full option fields
- [x] SCSS folder structure + `sass/style.scss` entry

### Phase 2 — Core Layout (Week 2) ✅ COMPLETE

- [x] Header partials (top-bar, header-main, mobile-off-canvas)
- [x] Footer partials (pre-footer-cta, footer-widgets, footer-bottom)
- [x] Breadcrumb band
- [x] Sticky header + mobile menu JS
- [x] Layout SCSS (_header, _footer, _navigation, _mega-menu, _mobile-menu)

### Phase 3 — Homepage (Week 3) ✅ COMPLETE

- [x] `hero-slider.php` + Swiper JS
- [x] Renamed / rewrote `about-intro.php` → `why-choose-us.php`
- [x] Renamed / rewrote `services-grid.php` → `services-overview.php`
- [x] Renamed / rewrote `portfolio-preview.php` → `projects-preview.php`
- [x] New `featured-collections.php` (queries `marbure_product` CPT)
- [x] `stats-counter.php` + CountUp.js
- [x] `testimonials-carousel.php` + Swiper
- [x] `blog-grid.php`
- [x] `cta-band.php`
- [x] `marquee-strip.php`
- [x] Updated `page-home.php` section order to Tiles & Flooring layout

### Phase 4 — Inner Pages (Week 4) ✅ COMPLETE

- [x] `archive-marbure_product.php` + taxonomy filter bar + `content-product.php`
- [x] `single-marbure_product.php` — specs table, taxonomy chips, related products, datasheet CTA
- [x] `archive-marbure_project.php` + Isotope + `content-project.php`
- [x] `single-marbure_project.php` — meta band, tiles used sidebar, related projects
- [x] `page-templates/page-about.php`
- [x] `page-templates/page-services.php` — 4 alternating service layout
- [x] `page-templates/page-gallery.php` — GLightbox + Isotope project filter
- [x] `page-templates/page-quote.php` — quote form + 3-step info + contact card
- [x] `page-templates/page-contact.php`
- [x] `page-templates/page-faq.php`
- [x] `page-templates/page-testimonials.php`
- [x] `archive.php` + `single.php`
- [x] `404.php` + `search.php`

### Phase 5 — Elementor Widgets (Week 5) ✅ COMPLETE

- [x] `inc/elementor/elementor-support.php` — updated to 10 widgets
- [x] `widget-product-card.php` — product grid with material/size/finish repeater
- [x] `widget-project-card.php` — project grid with location/type/area repeater
- [x] `widget-gallery-grid.php` — GLightbox gallery with Isotope filter
- [x] `widget-hero-slider.php`
- [x] `widget-stat-counter.php`
- [x] `widget-testimonial-carousel.php`
- [x] `widget-faq-accordion.php`
- [x] `widget-cta-band.php`
- [x] `widget-marquee-strip.php`
- [x] `theme.json`
- [x] Block patterns
- [x] `editor-style.css`
- [x] `inc/kirki/sections/cpts.php` — updated to `product_*` / `project_*` keys

### Phase 6 — ThemeForest Polish (Week 6) ✅ COMPLETE

- [x] `_rtl.scss` + `style-rtl.css`
- [x] WCAG 2.1 AA — focus states, reduced-motion, high-contrast
- [x] `inc/schema.php` — `HomeAndConstructionBusiness`, `Product`, `CreativeWork`, `FAQPage`, `Article`, `AggregateRating`
- [x] `inc/og-meta.php` — Open Graph + Twitter Card
- [x] Demo content XML (`assets/demo/demo-content.xml`)
- [x] Customizer settings export (`assets/demo/customizer-settings.dat`)
- [x] Child theme (`themes/marbure-child/`)
- [x] `screenshot.png`
- [ ] Run Theme Check plugin *(WP Admin → Appearance → Theme Check)*
- [ ] HTML documentation

---

## 15. ThemeForest Compliance Checklist

### Code Quality
- [ ] GPL 2.0+ license in `style.css`
- [ ] All strings in `__()`, `esc_html__()`, `esc_attr__()`
- [ ] No PHP errors with `WP_DEBUG true`
- [ ] Passes Theme Check plugin with zero errors

### Compatibility
- [ ] WordPress 6.5+ tested
- [ ] PHP 8.1+ tested
- [ ] Elementor 3.x compatible
- [ ] WooCommerce basic compatibility
- [ ] Jetpack compatible

### Accessibility
- [ ] WCAG 2.1 AA color contrast
- [ ] Visible focus states on all interactive elements
- [ ] Skip-to-content link
- [ ] ARIA labels on icon-only buttons
- [ ] Keyboard navigable mega menu + mobile menu

### Internationalisation
- [ ] `.pot` file up-to-date
- [ ] `style-rtl.css` present
- [ ] `load_theme_textdomain()` called correctly

### Packaging
- [ ] Child theme included
- [ ] Demo content XML included
- [ ] Customizer export `.dat` included
- [ ] Screenshot at 1200×900px
- [ ] HTML documentation

---

*Next: Start Phase 3 updates — rename homepage sections from Law Firm to Tiles & Flooring.*
