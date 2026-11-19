/**
 * Shared Cloudflare Turnstile helpers for theme forms.
 */
(function () {
    'use strict';

    function getWidgetElement(form) {
        if (form) {
            return form.querySelector('.cf-turnstile');
        }
        return document.querySelector('.cf-turnstile');
    }

    function getToken(form) {
        var scope = form || document;
        var input = scope.querySelector('[name="cf-turnstile-response"]');
        if (input && input.value) {
            return input.value;
        }

        if (typeof window.turnstile !== 'undefined') {
            var widgetEl = getWidgetElement(form);
            if (widgetEl) {
                var widgetId = widgetEl.getAttribute('data-turnstile-widget-id');
                if (widgetId) {
                    var response = window.turnstile.getResponse(widgetId);
                    if (response) {
                        return response;
                    }
                }
            }
        }

        return '';
    }

    function resetForm(form) {
        if (typeof window.turnstile === 'undefined') {
            return;
        }

        var widgetEl = getWidgetElement(form);
        if (!widgetEl) {
            return;
        }

        var widgetId = widgetEl.getAttribute('data-turnstile-widget-id');
        if (widgetId) {
            window.turnstile.reset(widgetId);
            return;
        }

        window.turnstile.reset(widgetEl);
    }

    function requireToken(form) {
        if (!document.querySelector('.cf-turnstile')) {
            return true;
        }
        return getToken(form) !== '';
    }

    window.juliusTurnstile = {
        getToken: getToken,
        resetForm: resetForm,
        requireToken: requireToken
    };
})();