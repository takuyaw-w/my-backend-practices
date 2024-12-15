# 認証関連 API

## 共通情報

- ベース URL: `https://api.example.com`
- リクエスト形式: `application/json`
- レスポンス形式: `application/json`
- 認証方式: API トークン (Authorization ヘッダーに `Bearer {token}` を付与)

---

### **1. 認証関連エンドポイント**

#### **1.1 ユーザー登録**

- **エンドポイント**: `POST /auth/register`
- **概要**: 新規ユーザーの登録
- **リクエストボディ**:
  ```json
  {
    "name": "string",
    "email": "string",
    "password": "string"
  }
  ```
- **レスポンス例**:
  - **201 Created**
    ```json
    {
      "id": 1,
      "name": "string",
      "email": "string",
      "role": "user",
      "token": "string"
    }
    ```
  - **422 Unprocessable Entity**
    ```json
    {
      "message": "Validation error",
      "errors": {
        "email": ["The email has already been taken."]
      }
    }
    ```

#### **1.2 管理者登録**

- **エンドポイント**: `POST /auth/admin-register`
- **概要**: 管理者ユーザーの登録 (管理者専用)
- **リクエストボディ**:
  ```json
  {
    "name": "string",
    "email": "string",
    "password": "string"
  }
  ```
- **レスポンス例**:
  - **201 Created**
    ```json
    {
      "id": 1,
      "name": "string",
      "email": "string",
      "role": "admin",
      "token": "string"
    }
    ```
  - **403 Forbidden**
    ```json
    {
      "message": "You are not authorized to access this resource."
    }
    ```

#### **1.3 ユーザー認証 (ログイン)**

- **エンドポイント**: `POST /auth/login`
- **概要**: ユーザーの認証およびトークン発行
- **リクエストボディ**:
  ```json
  {
    "email": "string",
    "password": "string"
  }
  ```
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "token": "string"
    }
    ```
  - **401 Unauthorized**
    ```json
    {
      "message": "Invalid credentials."
    }
    ```
