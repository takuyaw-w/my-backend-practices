# **テーブル定義書**

## **1. テーブル: `users`**

ユーザー情報を格納するテーブル。

| カラム名     | データ型     | 必須 | 主キー | 説明                        |
| ------------ | ------------ | ---- | ------ | --------------------------- |
| `id`         | SERIAL       | YES  | YES    | ユーザー ID (自動増分)      |
| `name`       | VARCHAR(255) | YES  | NO     | ユーザー名                  |
| `email`      | VARCHAR(255) | YES  | NO     | メールアドレス              |
| `password`   | VARCHAR(255) | YES  | NO     | パスワード (ハッシュ化)     |
| `role`       | VARCHAR(50)  | YES  | NO     | ユーザーの役割 (user/admin) |
| `deleted_at` | TIMESTAMP    | NO   | NO     | 論理削除用のタイムスタンプ  |
| `created_at` | TIMESTAMP    | YES  | NO     | 作成日時                    |
| `updated_at` | TIMESTAMP    | YES  | NO     | 更新日時                    |
| `created_pg` | VARCHAR(255) | NO   | NO     | 作成プログラム              |
| `updated_pg` | VARCHAR(255) | NO   | NO     | 更新プログラム              |

---

## **2. テーブル: `api_tokens`**

API トークンを管理するテーブル。

| カラム名     | データ型     | 必須 | 主キー | 説明                        |
| ------------ | ------------ | ---- | ------ | --------------------------- |
| `id`         | SERIAL       | YES  | YES    | トークン ID (自動増分)      |
| `user_id`    | INT          | YES  | NO     | トークン所有者のユーザー ID |
| `token`      | VARCHAR(255) | YES  | NO     | API トークン                |
| `expires_at` | TIMESTAMP    | NO   | NO     | トークンの有効期限          |
| `deleted_at` | TIMESTAMP    | NO   | NO     | トークンが無効化された時刻  |
| `created_at` | TIMESTAMP    | YES  | NO     | 作成日時                    |
| `updated_at` | TIMESTAMP    | YES  | NO     | 更新日時                    |
| `created_pg` | VARCHAR(255) | NO   | NO     | 作成プログラム              |
| `updated_pg` | VARCHAR(255) | NO   | NO     | 更新プログラム              |

---

## **3. テーブル: `todos`**

TODO 情報を格納するテーブル。

| カラム名           | データ型     | 必須 | 主キー | 説明                       |
| ------------------ | ------------ | ---- | ------ | -------------------------- |
| `id`               | SERIAL       | YES  | YES    | TODO ID (自動増分)         |
| `title`            | VARCHAR(255) | YES  | NO     | TODO のタイトル            |
| `description`      | TEXT         | NO   | NO     | TODO の詳細説明            |
| `due_date`         | TIMESTAMP    | NO   | NO     | 期限日時                   |
| `status`           | VARCHAR(50)  | YES  | NO     | TODO のステータス          |
| `assigned_user_id` | INT          | NO   | NO     | アサインされたユーザー ID  |
| `created_by`       | INT          | YES  | NO     | 作成者のユーザー ID        |
| `deleted_at`       | TIMESTAMP    | NO   | NO     | 論理削除用のタイムスタンプ |
| `created_at`       | TIMESTAMP    | YES  | NO     | 作成日時                   |
| `updated_at`       | TIMESTAMP    | YES  | NO     | 更新日時                   |
| `created_pg`       | VARCHAR(255) | NO   | NO     | 作成プログラム             |
| `updated_pg`       | VARCHAR(255) | NO   | NO     | 更新プログラム             |

---

## **4. テーブル: `comments`**

コメント情報を格納するテーブル。

| カラム名     | データ型     | 必須 | 主キー | 説明                          |
| ------------ | ------------ | ---- | ------ | ----------------------------- |
| `id`         | SERIAL       | YES  | YES    | コメント ID (自動増分)        |
| `body`       | TEXT         | YES  | NO     | コメント本文                  |
| `user_id`    | INT          | YES  | NO     | コメントを投稿したユーザー ID |
| `todo_id`    | INT          | YES  | NO     | コメント対象の TODO ID        |
| `deleted_at` | TIMESTAMP    | NO   | NO     | 論理削除用のタイムスタンプ    |
| `created_at` | TIMESTAMP    | YES  | NO     | 作成日時                      |
| `updated_at` | TIMESTAMP    | YES  | NO     | 更新日時                      |
| `created_pg` | VARCHAR(255) | NO   | NO     | 作成プログラム                |
| `updated_pg` | VARCHAR(255) | NO   | NO     | 更新プログラム                |

---

## **5. テーブル: `logs`**

システム操作ログを格納するテーブル。

| カラム名           | データ型     | 必須 | 主キー | 説明                                 |
| ------------------ | ------------ | ---- | ------ | ------------------------------------ |
| `id`               | SERIAL       | YES  | YES    | ログ ID (自動増分)                   |
| `endpoint`         | VARCHAR(255) | YES  | NO     | リクエストされたエンドポイント       |
| `method`           | VARCHAR(50)  | YES  | NO     | HTTP メソッド (GET, POST など)       |
| `request_payload`  | JSON         | NO   | NO     | リクエストの内容                     |
| `response_payload` | JSON         | NO   | NO     | レスポンスの内容                     |
| `user_id`          | INT          | NO   | NO     | 実行したユーザー ID (認証済みの場合) |
| `token_id`         | INT          | NO   | NO     | 利用されたトークンの ID              |
| `created_at`       | TIMESTAMP    | YES  | NO     | 作成日時                             |
| `created_pg`       | VARCHAR(255) | NO   | NO     | 作成プログラム                       |

---

### **補足**

- **リレーション**:
  - `api_tokens.user_id` は `users.id` に紐づく。
  - `todos.assigned_user_id` は `users.id` に紐づく。
  - `comments.user_id` は `users.id` に紐づく。
  - `comments.todo_id` は `todos.id` に紐づく。
  - `logs.user_id` は `users.id` に紐づく。
  - `logs.token_id` は `api_tokens.id` に紐づく。
