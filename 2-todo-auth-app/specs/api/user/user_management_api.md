# ユーザー管理 API

## 共通情報

- ベース URL: `https://api.example.com`
- リクエスト形式: `application/json`
- レスポンス形式: `application/json`
- 認証方式: API トークン (Authorization ヘッダーに `Bearer {token}` を付与)

---

### **2. ユーザー管理エンドポイント**

#### **2.1 ユーザー一覧取得**

- **エンドポイント**: `GET /users`
- **概要**: 全ユーザーの一覧取得 (管理者専用)
- **レスポンス例**:
  - **200 OK**
    ```json
    [
      {
        "id": 1,
        "name": "string",
        "email": "string",
        "role": "user",
        "created_at": "timestamp"
      }
    ]
    ```

#### **2.2 ユーザー詳細取得**

- **エンドポイント**: `GET /users/{id}`
- **概要**: 特定ユーザーの詳細取得 (管理者または本人のみ)
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "id": 1,
      "name": "string",
      "email": "string",
      "role": "user",
      "created_at": "timestamp"
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "User not found."
    }
    ```

#### **2.3 ユーザー情報更新**

- **エンドポイント**: `PUT /users/{id}`
- **概要**: ユーザー情報の更新 (管理者または本人のみ)
- **リクエストボディ**:
  ```json
  {
    "name": "updated name",
    "email": "updated email",
    "password": "new password"
  }
  ```
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "id": 1,
      "name": "updated name",
      "email": "updated email",
      "role": "user",
      "updated_at": "timestamp"
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "User not found."
    }
    ```

#### **2.4 ユーザー削除**

- **エンドポイント**: `DELETE /users/{id}`
- **概要**: ユーザーの削除 (管理者または本人のみ)
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "message": "User deleted successfully."
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "User not found."
    }
    ```
