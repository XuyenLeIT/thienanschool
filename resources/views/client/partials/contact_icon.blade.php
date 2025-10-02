<!-- 🔥 Floating Contact Buttons -->
<style>
    /* =============================
         🔥 Vị trí và layout chính
      ============================== */
    .contact-floating {
        position: fixed;
        bottom: 115px;
        right: 20px;
        display: flex;
        flex-direction: column;     /* xếp dọc */
        gap: 15px;
        z-index: 9999;
        align-items: flex-end;      /* căn phải */
    }

    /* =============================
         🔥 Kiểu chung cho các nút
      ============================== */
    .contact-btn {
        min-width: 60px;
        height: 60px;
        border-radius: 50px;        /* phone có thể kéo dài khi hiển thị số */
        background: #0d6efd;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 22px;
        padding: 0 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        animation: pulseRing 2s infinite;
        transition: all 0.3s ease;
        white-space: nowrap;
        overflow: hidden;
    }

    /* Icon chung */
    .contact-btn i,
    .contact-btn img {
        margin-right: 8px;
    }

    /* =============================
         🔥 Phone Button
      ============================== */
    .phone-btn {
        background: linear-gradient(45deg, #28a745, #34d058);
    }

    /* Class riêng cho icon phone */
    .phone-icon {
        font-size: 22px;
    }

    /* =============================
         🔥 Zalo Button
      ============================== */
    .zalo-btn {
        background: #0068ff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        padding: 0;
        justify-content: center;
    }

    .zalo-btn img {
        width: 28px;
        height: 28px;
        margin-right: 0;
    }

    /* Hiệu ứng lan tỏa */
    @keyframes pulseRing {
        0%   { box-shadow: 0 0 0 0 rgba(13,110,253,0.4); }
        70%  { box-shadow: 0 0 0 20px rgba(13,110,253,0); }
        100% { box-shadow: 0 0 0 0 rgba(13,110,253,0); }
    }

    /* =============================
         🔥 Hover hiệu ứng cho Desktop & Tablet
      ============================== */
    @media (min-width: 769px) {
        .phone-btn {
            width: 60px;                /* mặc định nhỏ */
            padding: 0 20px;
        }

        .phone-btn .phone-text {
            opacity: 0;
            max-width: 0;
            transition: all 0.3s ease;
        }

        /* Khi hover → kéo dài nút và hiện số */
        .phone-btn:hover {
            width: 200px;                /* 👉 giãn ngang */
            border-radius: 50px;
        }

        .phone-btn:hover .phone-text {
            opacity: 1;
            max-width: 150px;            /* 👉 hiện số */
            margin-left: 10px;
        }
    }

    /* =============================
         🔥 Responsive cho Mobile
      ============================== */
    @media (max-width: 768px) {

        /* Ẩn số điện thoại */
        .phone-text {
            display: none !important;
        }

        /* Icon phone đứng yên, không lệch */
        .phone-icon {
            margin-right: 0 !important;
        }

        /* Nút tròn, không giãn */
        .phone-btn,
        .zalo-btn,
        .contact-btn {
            width: 55px !important;
            height: 55px !important;
            border-radius: 50% !important;
            padding: 0 !important;
            justify-content: center !important;
            transition: none !important;
        }

        /* 🚫 Tắt hiệu ứng hover trên mobile */
        .contact-btn:hover {
            transform: none !important;
            width: 55px !important;
        }
    }
</style>

<!-- =============================
         🔥 HTML Floating Buttons
      ============================== -->
<div class="contact-floating">
    <!-- 📞 Phone -->
    <a href="tel:0912345678" class="contact-btn phone-btn" title="Gọi ngay">
        <i class="fa-solid fa-phone phone-icon"></i>
        <span class="phone-text">0912&nbsp;345&nbsp;678</span>
    </a>

    <!-- 💬 Zalo -->
    <a href="https://zalo.me/0382907702" target="_blank" class="contact-btn zalo-btn" title="Nhắn Zalo">
        <img src="icon/zaloicon.png" alt="Zalo">
    </a>
</div>
