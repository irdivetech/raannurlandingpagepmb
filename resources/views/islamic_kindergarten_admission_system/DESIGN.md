---
name: Islamic Kindergarten Admission System
colors:
  surface: '#f7f9fb'
  surface-dim: '#d8dadc'
  surface-bright: '#f7f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f6'
  surface-container: '#eceef0'
  surface-container-high: '#e6e8ea'
  surface-container-highest: '#e0e3e5'
  on-surface: '#191c1e'
  on-surface-variant: '#3e4a3d'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f3'
  outline: '#6e7b6c'
  outline-variant: '#bdcaba'
  surface-tint: '#006e2d'
  primary: '#006b2c'
  on-primary: '#ffffff'
  primary-container: '#00873a'
  on-primary-container: '#f7fff2'
  inverse-primary: '#62df7d'
  secondary: '#6d5e00'
  on-secondary: '#ffffff'
  secondary-container: '#fcdf46'
  on-secondary-container: '#726200'
  tertiary: '#515c71'
  on-tertiary: '#ffffff'
  tertiary-container: '#6a758a'
  on-tertiary-container: '#fefcff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#7ffc97'
  primary-fixed-dim: '#62df7d'
  on-primary-fixed: '#002109'
  on-primary-fixed-variant: '#005320'
  secondary-fixed: '#ffe24c'
  secondary-fixed-dim: '#e2c62d'
  on-secondary-fixed: '#211b00'
  on-secondary-fixed-variant: '#524600'
  tertiary-fixed: '#d8e3fb'
  tertiary-fixed-dim: '#bcc7de'
  on-tertiary-fixed: '#111c2d'
  on-tertiary-fixed-variant: '#3c475a'
  background: '#f7f9fb'
  on-background: '#191c1e'
  surface-variant: '#e0e3e5'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 60px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.05em
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 16px
  lg: 24px
  xl: 32px
  gutter: 24px
  container-max: 1280px
---

## Brand & Style
The design system balances the structural reliability of a modern SaaS platform with the warmth and accessibility required for an early-childhood Islamic educational environment. The brand personality is **nurturing, organized, and spiritually uplifting**. It aims to evoke a sense of professional competence for administrative tasks while remaining approachable and welcoming for parents embarking on their child’s educational journey.

The design style is **Modern Corporate with Soft Accents**. It utilizes high whitespace and a clean "Paper" aesthetic to ensure clarity in complex forms. This is softened by organic, rounded corners and subtle yellow highlights that act as "sunlight" across the interface, symbolizing growth and optimism.

## Colors
The palette is rooted in a "Nature and Growth" theme.
- **Primary (Soft Green):** Used for primary actions, success states, and progress indicators. It represents life, growth, and the Islamic identity.
- **Secondary (Soft Yellow):** Used sparingly as an accent for highlights, warnings, or to draw attention to "new" features. It adds a cheerful, childlike energy without sacrificing professionalism.
- **Neutral/Surface:** A foundation of pure white (#FFFFFF) for cards and a very light cool grey (#F8FAFC) for background fills to create subtle contrast between layers.
- **Text:** Deep slate (#1E293B) is used for high-readability typography, avoiding the harshness of pure black.

## Typography
The typography strategy uses a pairing of **Plus Jakarta Sans** for headings and **Inter** for functional text. 
- **Plus Jakarta Sans** provides a slightly rounded, friendly geometric feel that fits the kindergarten context perfectly while remaining modern.
- **Inter** ensures that dense student data and multi-step forms remain highly legible and professional.
- Use **Display** sizes for landing pages and welcome screens.
- Use **Headline** sizes for dashboard section titles and card headers.
- Use **Label** styles for form field titles and status badges.

## Layout & Spacing
This design system employs a **strict 8px square grid** to maintain mathematical harmony across the SaaS platform.
- **Container Strategy:** A fixed-width centered container (1280px) is used for parent-facing portals to maintain focus. For administrative dashboards, a fluid layout with a fixed sidebar (280px) is preferred.
- **Dashboard Grid:** A 12-column grid system is used.
    - **Desktop:** 24px gutters, 32px outer margins.
    - **Tablet:** 16px gutters, 24px outer margins.
    - **Mobile:** 16px gutters, 16px outer margins (content typically stacks to 1 column).
- **Vertical Rhythm:** Use consistent increments of 8px (16, 24, 32, 48) to separate sections.

## Elevation & Depth
To achieve a "Friendly SaaS" look, the design system avoids heavy shadows in favor of **Tonal Layers and Soft Ambient Shadows**.
- **Level 0 (Background):** #F8FAFC.
- **Level 1 (Cards/Sidebar):** White (#FFFFFF) with a 1px border of #E2E8F0. No shadow.
- **Level 2 (Active States/Dropdowns):** White with a soft, diffused shadow: `0px 4px 20px rgba(0, 0, 0, 0.05)`.
- **Level 3 (Modals):** White with a deep, protective shadow: `0px 10px 32px rgba(0, 0, 0, 0.10)`.
- **The "Highlight" Effect:** Use a 4px left-border of Secondary Yellow on active sidebar items or "important" notification cards to indicate focus without adding visual weight.

## Shapes
The shape language is consistently **Rounded**. 
- A standard radius of **12px** (rounded-lg) is used for primary UI elements like input fields, buttons, and small cards.
- Larger containers and main dashboard cards use **16px** (rounded-xl) to emphasize the friendly, soft aesthetic.
- **Status Badges** and **Avatars** should be fully circular (pill-shaped) to provide a visual counterpoint to the structured grid.

## Components
- **Buttons:** 
  - *Primary:* Filled Green (#16A34A) with white text, 12px radius.
  - *Secondary:* Soft Yellow fill with dark slate text for "Special" actions like 'Apply Now'.
  - *Ghost:* No fill, Green border/text for less urgent actions.
- **Inputs:** High-contrast fields with 1px light grey borders that transition to a 2px Green border on focus. Include clear helper text in `body-sm`.
- **Progress Wizards:** Horizontal steps using Green circles with checkmarks for completion. Current step should have a Yellow halo to denote "Active."
- **Cards:** White background, 16px padding, 12px or 16px corner radius. Group related student info into these distinct "islands" of content.
- **Status Badges:** Use low-saturation background tints. E.g., "Pending" uses a pale yellow background with dark yellow text; "Admitted" uses a pale green background with dark green text.
- **Sidebar:** Professional Slate (#1E293B) or clean White. If white, use a subtle right-border and a Green active-state indicator for the selected menu item.