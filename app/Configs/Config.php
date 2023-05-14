<?php
namespace App\Configs;

interface Config{ 

    const BASE_URL = 'http://localhost:8000';
    
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'demo';

    const PORTPOS_PAGE_BASE_URL = 'https://payment-sandbox.portwallet.com/payment/?invoice=';
    const PORTPOS_API_BASE_URL = 'https://api-sandbox.portpos.com/payment';
    const PORTPOS_APP_KEY = 'db09e1518d5f4ebddc74db6877791573';
    const PORTPOS_SECRET_KEY = '882320eeca83f9e79e61cb9b15b57b81';
}