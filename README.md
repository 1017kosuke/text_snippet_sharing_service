# SharePet 🐾  
A lightweight code snippet sharing service.
<img width="939" height="863" alt="{9D44B469-EE36-44DA-8821-D2E7EBA43983}" src="https://github.com/user-attachments/assets/e819a1cf-81d9-4016-8a5f-d34481ef9069" />


---

## English

### Overview
SharePet is a web application that allows users to create, store, and share code snippets through unique URLs.  
It provides a simple and intuitive interface with syntax highlighting support.

---

### Features
- Create and store code snippets  
- Generate unique shareable URLs  
- Syntax highlighting (Monaco Editor)  
- Language switching (English / Japanese)  
- Simple and easy setup  
- Secure unique link generation  

---

### Tech Stack
- **Backend:** PHP 8 (OOP, no framework)  
- **Database:** MySQL  
- **Frontend:** HTML, CSS (Bootstrap), JavaScript  
- **Editor:** Monaco Editor  

---

### Key Highlights
- Built without frameworks to deepen understanding of backend fundamentals  
- Custom routing system implemented from scratch  
- Database abstraction using a custom MySQL wrapper  
- CLI-based migration and seeding system  

---

### CLI Commands

#### Reset Database
```bash
php console db-wipe
```

Clears all data from the database for development reset.

---

#### Run Migrations
```bash
php console migrate up
```

Applies pending database migrations.

---

#### Roll Back Migrations
```bash
php console migrate down
```

Reverts the latest migration.

---

#### Initialize Migration State
```bash
php console state-migrate --init
```

Initializes the migration tracking system.

---

#### Seed Database
```bash
php console seed
```

Inserts sample data for testing.

---

### Learning Purpose
This project was developed to strengthen understanding of:

- Backend architecture without frameworks  
- Routing and request handling  
- Database design and relationships  
- Secure SQL execution using prepared statements  
- Migration and seeding systems  
- Full-stack development  

---

## 🇯🇵 日本語

### 概要
SharePetは、コードやテキストスニペットを作成・保存し、ユニークURLを通して共有できるWebアプリケーションです。  
シンプルなUIとシンタックスハイライト機能により、コードを分かりやすく共有できます。

---

### 主な機能
- コード / テキストスニペットの作成・保存  
- ユニークURLによる共有  
- シンタックスハイライト表示（Monaco Editor）  
- 英語 / 日本語の言語切り替え  
- 簡単なセットアップ  
- 安全なリンク生成  

---

### 技術スタック
- **バックエンド:** PHP 8（OOP・フレームワークなし）  
- **データベース:** MySQL  
- **フロントエンド:** HTML, CSS（Bootstrap）, JavaScript  
- **エディタ:** Monaco Editor  

---

### 技術的なポイント
- フレームワークを使わずバックエンドの基礎理解を重視  
- 独自のルーティングシステムを実装  
- MySQLWrapperによるDB操作の抽象化  
- CLIによるマイグレーション / シーディング機能  

---

### CLIコマンド

#### データベース初期化
```bash
php console db-wipe
```

データベース内のデータを削除し、開発環境をリセットします。

---

#### マイグレーション実行
```bash
php console migrate up
```

未実行のマイグレーションを適用します。

---

#### マイグレーションのロールバック
```bash
php console migrate down
```

直近のマイグレーションを取り消します。

---

#### マイグレーション状態の初期化
```bash
php console state-migrate --init
```

マイグレーション管理用テーブルを初期化します。

---

#### シードデータ投入
```bash
php console seed
```

テスト用データをデータベースに追加します。

---

### 学習目的
このプロジェクトは以下の理解を深めるために開発しました：

- フレームワークに依存しないバックエンド設計  
- ルーティングとリクエスト処理  
- データベース設計とリレーション  
- Prepared Statementによる安全なSQL実行  
- マイグレーションとシーディングの仕組み  
- フルスタック開発  

---



![PHP](https://img.shields.io/badge/PHP-8-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)



