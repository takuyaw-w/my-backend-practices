# TODO 管理 API

## 共通情報

- ベース URL: `https://api.example.com`
- リクエスト形式: `application/json`
- レスポンス形式: `application/json`
- 認証方式: API トークン (Authorization ヘッダーに `Bearer {token}` を付与)

---

### **3. TODO 管理エンドポイント**

#### **3.1 TODO 一覧取得**

- **エンドポイント**: `GET /todos`
- **概要**: TODO リストの取得
- **レスポンス例**:
  - **200 OK**
    ```json
    [
      {
        "id": 1,
        "title": "string",
        "description": "string",
        "due_date": "date",
        "status": "string",
        "created_by": 1,
        "assigned_user_id": 2
      }
    ]
    ```

#### **3.2 TODO 詳細取得**

- **エンドポイント**: `GET /todos/{id}`
- **概要**: 特定 TODO の詳細取得
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "id": 1,
      "title": "string",
      "description": "string",
      "due_date": "date",
      "status": "string",
      "created_by": 1,
      "assigned_user_id": 2
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "TODO not found."
    }
    ```

#### **3.3 TODO 作成**

- **エンドポイント**: `POST /todos`
- **概要**: 新規 TODO の作成
- **リクエストボディ**:
  ```json
  {
    "title": "string",
    "description": "string",
    "due_date": "date",
    "status": "string"
  }
  ```
- **レスポンス例**:
  - **201 Created**
    ```json
    {
      "id": 1,
      "title": "string",
      "description": "string",
      "due_date": "date",
      "status": "string",
      "created_by": 1,
      "assigned_user_id": null
    }
    ```
  - **422 Unprocessable Entity**
    ```json
    {
      "message": "Validation error",
      "errors": {
        "title": ["The title field is required."]
      }
    }
    ```

#### **3.4 TODO 削除**

- **エンドポイント**: `DELETE /todos/{id}`
- **概要**: TODO の削除
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "message": "TODO deleted successfully."
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "TODO not found."
    }
    ```
