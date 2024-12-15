# ログ設計書

本ドキュメントでは、システム内部の動作を記録するためのロギング仕様を定義します。

## **1. ログの目的**

- API のリクエスト・レスポンスや重要なシステムイベントを記録し、デバッグや監査の用途に使用します。

## **2. ログの格納場所**

- **ストレージ**: データベース (PostgreSQL)
- **テーブル名**: `logs`

## **3. ログの構造**

ログは以下の構造を持ちます：

| カラム名           | 型        | 説明                                   |
| ------------------ | --------- | -------------------------------------- |
| `id`               | int       | 主キー                                 |
| `endpoint`         | string    | リクエストされたエンドポイント         |
| `method`           | string    | HTTP メソッド (GET, POST など)         |
| `request_payload`  | json      | リクエストボディ                       |
| `response_payload` | json      | レスポンスボディ                       |
| `user_id`          | int       | 実行したユーザーの ID (認証済みの場合) |
| `created_at`       | timestamp | ログが記録された時刻                   |

## **4. ログ出力のタイミング**

以下のタイミングでログを記録します：

- **リクエスト受信時**:
  - エンドポイント、HTTP メソッド、リクエストボディ。
- **レスポンス送信時**:
  - レスポンスボディと HTTP ステータスコード。
- **例外発生時**:
  - エラーメッセージ、スタックトレース。

## **5. バッチ処理練習用のデータ保持ポリシー**

- **データ保持ポリシー**:
  - 通常ログ: 90 日間保持 (練習用として定義)。
  - 重要ログ (例: 認証エラー): 無期限保持。

## **6. 実装例**

以下は、リクエストとレスポンスをロギングする際のコード例です：

```php
use Illuminate\Support\Facades\Log;

public function logRequestAndResponse(Request $request, $response)
{
    Log::channel('database')->info('API Log', [
        'endpoint' => $request->path(),
        'method' => $request->method(),
        'request_payload' => $request->all(),
        'response_payload' => $response->getContent(),
        'user_id' => auth()->id(),
        'created_at' => now(),
    ]);
}
```

## **7. ログの活用例**

- **デバッグ**:
  - 開発環境で API の動作確認やバグ修正時に使用。
- **監査**:
  - ユーザー操作履歴やセキュリティ監査のために保持。
- **統計**:
  - 使用頻度の高いエンドポイントを特定し、最適化に活用。
