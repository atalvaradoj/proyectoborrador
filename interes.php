<?php include "shared/header.php" ?>

<style>
    /* Estilos con colores que coinciden con testimonios.php */
    .main-container {
        max-width: 800px;
        margin: 0 auto;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 2.5rem;
        color: #007bff;
        font-weight: bold;
    }

    .content {
        background-color: #f0f7ff;
        /* Mismo color de fondo que en testimonios.php */
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 3px 6px rgba(0, 123, 255, 0.1);
        border: 1px solid #007bff;
    }

    .content h2 {
        font-size: 1.8rem;
        color: #007bff;
        /* Mismo color que los títulos en testimonios.php */
        margin-bottom: 20px;
    }

    .content p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #495057;
        /* Mismo color de texto que en testimonios.php */
    }

    .btn-primary {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 4px;
        text-align: center;
        color: white;
        text-decoration: none;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .main-container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .header h1 {
            font-size: 2rem;
        }

        .content {
            padding: