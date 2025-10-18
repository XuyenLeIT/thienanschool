<!-- 🔥 Floating Contact Buttons -->
<style>
    /* =============================
         📌 Layout chính và tránh tràn ngang
      ============================== */
    html, body {
        max-width: 100%;
        overflow-x: hidden !important;
    }

    .contact-floating {
        position: fixed;
        bottom: 70px;
        right: 10px; /* giảm để không tràn */
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 9999;
        align-items: flex-end;
        max-width: calc(100vw - 20px); /* tránh tràn trên mobile */
        overflow-x: hidden;
    }

    /* =============================
         🎨 Kiểu chung cho các nút
      ============================== */
    .contact-btn {
        min-width: 55px;
        height: 55px;
        border-radius: 50px;
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

    /* =============================
         ☎️ Phone Button
      ============================== */
    .phone-btn {
        background: linear-gradient(45deg, #28a745, #34d058);
    }

    .phone-icon {
        font-size: 22px;
    }

    /* =============================
         💬 Zalo Button
      ============================== */
    .zalo-btn {
        background: #0068ff;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        padding: 0;
        justify-content: center;
    }

    .zalo-btn img {
        width: 28px;
        height: 28px;
        margin-right: 0;
    }

    /* =============================
         ⬆️ Go Top Button
      ============================== */
    .gotop-btn {
        background: #6c757d;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
        cursor: pointer;
        transition: background 0.3s;
    }

    .gotop-btn:hover {
        background: #495057;
    }

    /* =============================
         🌊 Hiệu ứng lan tỏa
      ============================== */
    @keyframes pulseRing {
        0% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4);
        }
        70% {
            box-shadow: 0 0 0 20px rgba(13, 110, 253, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
        }
    }

    /* =============================
         💻 Hover cho Desktop
      ============================== */
    @media (min-width: 769px) {
        .phone-btn {
            width: 55px;
            padding: 0 20px;
        }

        .phone-btn .phone-text {
            opacity: 0;
            max-width: 0;
            transition: all 0.3s ease;
        }

        /* Khi hover → hiện số */
        .phone-btn:hover {
            width: 200px;
            border-radius: 50px;
        }

        .phone-btn:hover .phone-text {
            opacity: 1;
            max-width: 150px;
            margin-left: 10px;
        }
    }

    /* =============================
         📱 Responsive cho Mobile
      ============================== */
    @media (max-width: 768px) {
        .phone-text {
            display: none !important;
        }

        .phone-icon {
            margin-right: 0 !important;
        }

        .contact-btn,
        .zalo-btn,
        .phone-btn {
            width: 55px !important;
            height: 55px !important;
            border-radius: 50% !important;
            padding: 0 !important;
            justify-content: center !important;
            transition: none !important;
        }

        /* Tắt hiệu ứng hover */
        .contact-btn:hover {
            transform: none !important;
            width: 55px !important;
        }
    }
</style>

<div class="contact-floating">
    <!-- 📞 Gọi ngay -->
    <a href="tel:0912345678" class="contact-btn phone-btn" title="Gọi ngay">
        <i class="fa-solid fa-phone phone-icon"></i>
        <span class="phone-text">0982 563 652</span>
    </a>

    <!-- 💬 Zalo -->
    <a href="https://zalo.me/0382907702" target="_blank" class="contact-btn zalo-btn" title="Nhắn qua Zalo">
        <img src="/icon/zaloicon.png" alt="Zalo">
    </a>

    <!-- ⬆️ Lên đầu trang -->
    <button class="gotop-btn" title="Lên đầu trang" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
</div>
