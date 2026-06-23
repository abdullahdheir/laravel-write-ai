/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "surface-container-low": "#f3f3f3",
                "on-tertiary-container": "#ffe0cd",
                "on-secondary-fixed": "#1c1b1b",
                "on-primary-fixed-variant": "#5a00c6",
                "error": "#ba1a1a",
                "tertiary-fixed-dim": "#ffb784",
                "surface-container-lowest": "#ffffff",
                "on-primary-fixed": "#25005a",
                "on-tertiary": "#ffffff",
                "inverse-surface": "#2f3131",
                "on-error": "#ffffff",
                "primary": "#630ed4",
                "inverse-on-surface": "#f1f1f1",
                "error-container": "#ffdad6",
                "outline-variant": "#ccc3d8",
                "on-secondary-fixed-variant": "#474746",
                "on-primary": "#ffffff",
                "on-error-container": "#93000a",
                "surface-dim": "#dadada",
                "on-tertiary-fixed": "#301400",
                "surface": "#f9f9f9",
                "primary-container": "#7c3aed",
                "secondary": "#5f5e5e",
                "secondary-fixed": "#e5e2e1",
                "on-secondary": "#ffffff",
                "on-background": "#1a1c1c",
                "on-secondary-container": "#636262",
                "on-primary-container": "#ede0ff",
                "surface-variant": "#e2e2e2",
                "surface-container-highest": "#e2e2e2",
                "inverse-primary": "#d2bbff",
                "tertiary-container": "#a15100",
                "surface-bright": "#f9f9f9",
                "background": "#f9f9f9",
                "outline": "#7b7487",
                "tertiary": "#7d3d00",
                "on-surface": "#1a1c1c",
                "primary-fixed": "#eaddff",
                "secondary-container": "#e2dfde",
                "primary-fixed-dim": "#d2bbff",
                "on-tertiary-fixed-variant": "#713700",
                "secondary-fixed-dim": "#c8c6c5",
                "on-surface-variant": "#4a4455",
                "tertiary-fixed": "#ffdcc6",
                "surface-tint": "#732ee4",
                "surface-container": "#eeeeee",
                "surface-container-high": "#e8e8e8"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            spacing: {
                "section-gap": "4rem",
                "article-max": "720px",
                "container-max": "1200px",
                "margin-mobile": "1rem",
                "gutter": "1.5rem"
            },
            fontFamily: {
                "display-lg": ["Source Serif 4"],
                "ui-button": ["Inter"],
                "display-lg-mobile": ["Source Serif 4"],
                "ui-label": ["Inter"],
                "metadata": ["Inter"],
                "body-md": ["Source Serif 4"],
                "headline-md": ["Source Serif 4"],
                "body-lg": ["Source Serif 4"]
            },
            fontSize: {
                "display-lg": ["48px", {
                    "lineHeight": "1.2",
                    "letterSpacing": "-0.02em",
                    "fontWeight": "700"
                }],
                "ui-button": ["16px", {
                    "lineHeight": "1",
                    "letterSpacing": "0.02em",
                    "fontWeight": "600"
                }],
                "display-lg-mobile": ["32px", {
                    "lineHeight": "1.2",
                    "fontWeight": "700"
                }],
                "ui-label": ["14px", {
                    "lineHeight": "1.4",
                    "letterSpacing": "0.01em",
                    "fontWeight": "500"
                }],
                "metadata": ["12px", {
                    "lineHeight": "1.4",
                    "fontWeight": "400"
                }],
                "body-md": ["18px", {
                    "lineHeight": "1.6",
                    "fontWeight": "400"
                }],
                "headline-md": ["32px", {
                    "lineHeight": "1.3",
                    "fontWeight": "600"
                }],
                "body-lg": ["20px", {
                    "lineHeight": "1.6",
                    "fontWeight": "400"
                }]
            }
        },
    },
};
