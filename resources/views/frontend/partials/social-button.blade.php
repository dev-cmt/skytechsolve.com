<style>
    :root {
        --green-main: #00c853;
        --green-light: #03e78b;
        --shadow-soft: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .fixed-contact-wrapper {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    .toggle-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ED5933, #e70303);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(200, 0, 0, 0.4);
        transition: 0.25s ease;
        position: relative;
    }

    .toggle-button:hover {
        transform: scale(1.08);
        color: #fff;
    }

    .toggle-button::before {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: rgba(231, 3, 3, 0.3);
        animation: pulse 1.6s infinite;
        z-index: -1;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        70% {
            transform: scale(1.8);
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    .fixed-contact-buttons {
        position: absolute;
        bottom: 70px;
        right: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
        opacity: 0;
        transform: translateY(15px);
        pointer-events: none;
        transition: 0.3s ease;
    }

    .fixed-contact-buttons.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .social-outside {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        justify-content: flex-end;
    }

    .text-card {
        background: #fff;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        color: #4f5866;
        box-shadow: var(--shadow-soft);
        transition: transform 0.3s;
        white-space: nowrap;
    }

    .wp-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: var(--shadow-soft);
        transition: 0.3s ease;
    }

    .social-outside:hover .text-card {
        transform: translateX(-4px);
    }

    .social-outside:hover .wp-icon-circle {
        transform: scale(1.1);
    }

    .call .wp-icon-circle {
        background: linear-gradient(135deg, #E91E63, #8f0030ff);
    }

    .whatsapp .wp-icon-circle {
        background: linear-gradient(135deg, #25d366, #008832ff);
    }

    .messenger .wp-icon-circle {
        background: linear-gradient(135deg, #1877f2, #023d8bff);
    }

    @media (max-width: 480px) {
        .fixed-contact-wrapper {
            bottom: 20px;
            right: 10px;
        }
    }
</style>

<div class="fixed-contact-wrapper">

    <div class="fixed-contact-buttons" id="contactActions">
        @if (isset($settings->phone))
            <a href="https://wa.me/88{{ $settings->phone }}" target="_blank" class="social-outside whatsapp">
                <div class="text-card">WhatsApp</div>
                <div class="wp-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path
                            d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                    </svg>
                </div>
            </a>
        @endif
        @if (isset($settings->phone))
            <a href="tel:{{ $settings->phone }}" class="social-outside call">
                <div class="text-card">Call Us</div>
                <div class="wp-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-phone-call">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        <path d="M15 7a2 2 0 0 1 2 2" />
                        <path d="M15 3a6 6 0 0 1 6 6" />
                    </svg>
                </div>
            </a>
        @endif
        @if (isset($settings->facebook))
            <a href="{{ $settings->facebook }}" target="_blank" class="social-outside messenger">
                <div class="text-card">Messenger</div>
                <div class="wp-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                        class="icon icon-tabler icons-tabler-filled icon-tabler-brand-messenger">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M18.894 5.446c3.667 3.127 4.168 8.238 1.152 11.897c-2.842 3.447 -7.965 4.583 -12.231 2.805l-.233 -.101l-4.374 .931l-.033 .005l-.042 .008l-.031 .002l-.01 .003h-.018l-.052 .004l-.024 -.001l-.02 .001l-.033 -.003h-.035l-.022 -.004l-.022 -.002l-.035 -.007l-.034 -.005l-.016 -.004l-.024 -.005l-.049 -.016l-.024 -.005l-.011 -.005l-.022 -.007l-.045 -.02l-.03 -.012l-.011 -.006l-.014 -.006l-.031 -.018l-.045 -.024l-.016 -.011l-.037 -.026l-.04 -.027l-.015 -.013l-.043 -.04l-.025 -.02l-.062 -.07l-.013 -.013l-.011 -.014l-.027 -.04l-.026 -.035a1 1 0 0 1 -.054 -.095l-.006 -.013l-.019 -.045l-.02 -.042l-.004 -.016l-.004 -.01l-.011 -.04l-.013 -.04l-.002 -.014l-.005 -.019l-.005 -.033l-.008 -.042l-.002 -.031l-.003 -.026l-.004 -.054l.001 -.036l.001 -.023l.002 -.053l.004 -.025v-.019l.008 -.036l.005 -.033l.004 -.017l.005 -.023l.018 -.06l.003 -.013l1.15 -3.45l-.022 -.037c-2.21 -3.747 -1.209 -8.392 2.411 -11.118l.23 -.168c3.898 -2.766 9.469 -2.54 13.073 .535m-2.062 5a1 1 0 0 0 -1.387 -.278l-2.318 1.544l-1.42 -1.42a1 1 0 0 0 -1.262 -.124l-3 2a1 1 0 0 0 -.277 1.387l.07 .093a1 1 0 0 0 1.317 .184l2.317 -1.545l1.42 1.42a1 1 0 0 0 1.263 .125l3 -2a1 1 0 0 0 .277 -1.387" />
                    </svg>
                </div>
            </a>
        @endif

    </div>

    <a href="javascript:void(0)" id="mainToggle" class="toggle-button call-toggle" onclick="toggleContacts()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff"
            class="icon icon-tabler icons-tabler-filled icon-tabler-message-circle">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
                d="M5.821 4.91c3.899 -2.765 9.468 -2.539 13.073 .535c3.667 3.129 4.168 8.238 1.152 11.898c-2.841 3.447 -7.965 4.583 -12.231 2.805l-.233 -.101l-4.374 .931l-.04 .006l-.035 .007h-.018l-.022 .005h-.038l-.033 .004l-.021 -.001l-.023 .001l-.033 -.003h-.035l-.022 -.004l-.022 -.002l-.035 -.007l-.034 -.005l-.016 -.004l-.024 -.005l-.049 -.016l-.024 -.005l-.011 -.005l-.022 -.007l-.045 -.02l-.03 -.012l-.011 -.006l-.014 -.006l-.031 -.018l-.045 -.024l-.016 -.011l-.037 -.026l-.04 -.027l-.002 -.004l-.013 -.009l-.043 -.04l-.025 -.02l-.006 -.007l-.056 -.062l-.013 -.014l-.011 -.014l-.039 -.056l-.014 -.019l-.005 -.01l-.042 -.073l-.007 -.012l-.004 -.008l-.007 -.012l-.014 -.038l-.02 -.042l-.004 -.016l-.004 -.01l-.017 -.061l-.007 -.018l-.002 -.015l-.005 -.019l-.005 -.033l-.008 -.042l-.002 -.031l-.003 -.01v-.016l-.004 -.054l.001 -.036l.001 -.023l.002 -.053l.004 -.025v-.019l.008 -.035l.005 -.034l.005 -.02l.004 -.02l.018 -.06l.003 -.013l1.15 -3.45l-.022 -.037c-2.21 -3.747 -1.209 -8.391 2.413 -11.119z" />
        </svg>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const box = document.getElementById('contactActions');
        const toggleBtn = document.getElementById('mainToggle');
        const actions = box.querySelectorAll('.social-outside');

        if (!actions.length) toggleBtn.remove();

        if (actions.length === 1) {
            toggleBtn.remove();
            box.classList.add('show');
            return;
        }

        toggleBtn.addEventListener('click', () => {
            box.classList.toggle('show');
        });
    });
</script>