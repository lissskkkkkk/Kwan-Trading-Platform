# Kwan's Trading Platform (樂器實時交易平臺)

ICT校本評核（SBA）網站專案
本平台旨在解決網購樂器時「缺乏音色試聽」、「產品資訊不清晰」及「賣家後台管理困難」三大痛點，提供即時樂器試聽、線上購買與自動扣費、餘額增值，以及視覺化的管理員後台（新增/下架商品、跨表查詢訂單記錄）。

* **URL**：`http://lissskkkkkk.ct.ws/Kwan_Trading_Platform/main.html`

## 1. 網站目錄結構 

```text
├── main.html                   # 網站起始主頁
├── main.css                    # 主頁外部樣式表
├── login/
│   ├── loginui.html            # 登錄頁面 (含前端完整性驗證)
│   ├── logincss.css            # 登錄頁面樣式表
│   └── logindb.php             # 登錄後端驗證與角色分流 (admin / user)
├── register/
│   ├── register.html           # 註冊頁面 (含性別、興趣多選前端檢查)
│   ├── register.css            # 註冊頁面樣式表
│   └── register.php            # 註冊後端處理 (含用戶名唯一性檢查)
├── userpage/
│   ├── userpage.php            # 買家主界面 (餘額顯示、商品購買、音頻試聽表)
│   ├── buyproduct.php          # 購買商品扣款與寫入交易記錄後端
│   ├── logout.php              # 登出並清除 Session
│   ├── reload/
│   │   ├── reloadui.php        # 餘額增值界面 (含信用卡與金額格式驗證)
│   │   └── reload.php          # 餘額增值後端更新
│   └── sound/                  # 樂器試聽 MP3 音頻檔案夾
│       ├── soft-piano-100-bpm-121529.mp3
│       ├── violin-music-64019.mp3
│       ├── relaxing-guitar-loop-v5-245859.mp3
│       ├── cello-355430.mp3
│       ├── dizi-flute-02-72563.mp3
│       └── erhu-melodic-loop-62755.mp3
└── adminpage/
    ├── adminpage.php           # 管理員後台主頁 (含 Session 權限檢查)
    ├── delete/
    │   └── delete.php          # 視覺化下架/刪除商品
    ├── insert/
    │   ├── insert.html         # 新增商品表單
    │   └── insert.php          # 新增商品後端寫入
    └── query/
        └── query.php           # 跨資料表 (INNER JOIN) 查詢交易與用戶記錄
```

## 2. 數據庫結構 (`database_restore.sql`)

本專案使用 MySQL / MariaDB 數據庫，包含三個資料表：
1. `user`：儲存用戶與管理員資料（`ID`, `username`, `password`, `balance`, `email`, `tel`, `date`, `gender`, `interested`, `country`, `message`, `type`）。
2. `products`：儲存樂器商品與試聽音頻路徑（`productid`, `productname`, `price`, `description`, `file path`, `product_status`）。
3. `transactionrecords`：儲存購買訂單記錄（`Transactionid`, `username`, `productname`, `Transactiontime`）。

### 預設測試帳號：

| 角色類型 (`type`) | 用戶名 (`username`) | 密碼 (`password`) | 初始餘額 (`balance`) | 用途說明 |
| :--- | :--- | :--- | :--- | :--- |
| **管理員 (`admin`)** | `admin123456` | `admin123456` | `$999,999,999.99` | 報告書原版管理員帳號，可進入後台新增/刪除商品及查詢訂單 |
| **管理員 (`admin`)** | `admin` | `123456` | `$1,000,000.00` | 簡易測試管理員帳號 |
| **一般買家 (`user`)** | `sctt_ok` | `12345678` | `$1,000,000.00` | 報告書原版買家帳號，附帶 3 筆歷史購買記錄 |
| **一般買家 (`user`)** | `testuser1` | `123456` | `$1,000,000.00` | 充足餘額買家測試帳號，可測試購買鋼琴、小提琴、結他 |
| **一般買家 (`user`)** | `pooruser` | `123456` | `$50.00` | 低餘額買家測試帳號，可測試「餘額不足 (`Insufficient balance!`)」攔截提示 |
