# コメント管理 API

## 共通情報

- ベース URL: `https://api.example.com`
- リクエスト形式: `application/json`
- レスポンス形式: `application/json`
- 認証方式: API トークン (Authorization ヘッダーに `Bearer {token}` を付与)

---

### **4. コメント管理エンドポイント**

#### **4.1 コメント一覧取得**

- **エンドポイント**: `GET /todos/{id}/comments`
- **概要**: 指定した TODO のコメント一覧を取得
- **レスポンス例**:
  - **200 OK**
    ```json
    [
      {
        "id": 1,
        "body": "string",
        "user_id": 1,
        "todo_id": 1,
        "created_at": "timestamp"
      }
    ]
    ```

#### **4.2 コメント追加**

- **エンドポイント**: `POST /todos/{id}/comments`
- **概要**: TODO にコメントを追加
- **リクエストボディ**:
  ```json
  {
    "body": "string"
  }
  ```
- **レスポンス例**:
  - **201 Created**
    ```json
    {
      "id": 1,
      "body": "string",
      "user_id": 1,
      "todo_id": 1,
      "created_at": "timestamp"
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "TODO not found."
    }
    ```

#### **4.3 コメント削除**

- **エンドポイント**: `DELETE /todos/{id}/comments/{comment_id}`
- **概要**: コメントを削除 (投稿者のみ実行可能)
- **レスポンス例**:
  - **200 OK**
    ```json
    {
      "message": "Comment deleted successfully."
    }
    ```
  - **404 Not Found**
    ```json
    {
      "message": "Comment not found."
    }
    ```
