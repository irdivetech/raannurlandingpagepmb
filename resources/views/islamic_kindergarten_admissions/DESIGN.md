---
name: Islamic Kindergarten Admissions
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
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 30px
    fontWeight: '700'
    lineHeight: 36px
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
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
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
  status-badge:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1200px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 48px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style
The design system is centered on a "Gentle Growth" narrative, blending professional SaaS efficiency with the warmth of an early childhood educational environment. The target audience consists of parents seeking a secure, spiritual, and nurturing start for their children. 

The visual style is **Modern Corporate** with **Organic Softness**. It prioritizes high legibility and a welcoming atmosphere through generous whitespace and a "soft-touch" interface. While the backend logic is complex (admissions, document verification, payments), the front-end remains light and approachable to reduce parental anxiety during the application process.

## Colors
The palette is anchored by **Growth Green**, symbolizing life and Islamic heritage, balanced against a clean white canvas. **Sunlight Yellow** serves as a rhythmic accent for call-to-actions and highlights, evoking joy and childhood optimism.

- **Primary (#16A34A):** Used for main actions, active states, and brand-heavy elements.
- **Secondary (#FDE047):** Used sparingly for high-attention accents or decorative elements.
- **Surface:** A crisp white background is mandatory to maintain a professional "SaaS" feel. 
- **Status Colors:** Functional tokens for application tracking. Use low-saturation background tints (10% opacity) with high-contrast text for badges.

## Typography
The system utilizes **Plus Jakarta Sans** for headings to provide a friendly, slightly rounded geometric feel that aligns with the "Kindergarten" theme. **Inter** is used for all functional body text and form inputs to ensure maximum clarity and a professional SaaS aesthetic.

Hierarchy is maintained through tight leading and slight negative letter-spacing on large headers. For mobile views, large display type scales down aggressively to prevent awkward wrapping in multi-step application forms.

## Layout & Spacing
The layout follows a **12-column fluid grid** for desktop and a **4-column grid** for mobile. 

- **Desktop-First Strategy:** The application portal features a persistent left-hand "Step Progress" sidebar (fixed width: 280px) on desktop to provide a clear sense of journey. 
- **Mobile Adaptation:** On mobile, the sidebar collapses into a top-mounted progress bar. 
- **Spacing Rhythm:** An 8px base unit is used. Use `stack-lg` (32px) to separate major form sections and `stack-md` (16px) for individual input field groups.

## Elevation & Depth
This design system avoids heavy shadows to maintain a clean, modern look. Instead, it uses **Tonal Layers** and **Soft Ambient Shadows**.

- **Level 0 (Background):** #F8FAFC (Neutral-50).
- **Level 1 (Cards/Form Containers):** Pure White (#FFFFFF) with a 1px border in #E2E8F0.
- **Level 2 (Active Interaction/Modals):** Pure White with a subtle "Silk Shadow": `0 10px 15px -3px rgba(0, 0, 0, 0.05)`.
- **Interactive Depth:** Buttons use a subtle inner-glow on hover rather than a drop shadow to keep the interface feeling flat and modern.

## Shapes
The shape language is consistently **Rounded**. A standard radius of 12px-16px is applied to all primary containers.

- **Inputs/Buttons:** 12px (rounded-lg) for a friendly yet structured feel.
- **Status Badges:** Fully pill-shaped (rounded-full) to differentiate them from interactive buttons.
- **Image Containers:** 24px (rounded-2xl) to soften photos of students or campus facilities.

## Components
- **Buttons:** Primary buttons use Growth Green with white text. Secondary buttons use a White background with a 1px green border. Large 56px height for primary actions on mobile.
- **Status Badges:** Small, uppercase labels with a subtle 10% background tint matching the status token.
- **Input Fields:** 12px rounded corners with a 1px border. On focus, the border transitions to Growth Green with a 3px soft outer glow.
- **Application Progress Tracker:** A vertical line with nodes on desktop; horizontal "pill" indicators on mobile. Completed steps show a green checkmark icon.
- **Information Cards:** Used for tuition details or school requirements; feature a slight left-accent border in Sunlight Yellow to draw the eye.
- **Checkboxes/Radios:** Customized with 4px rounded corners for checkboxes and Growth Green fill when active.