# GitHub x Vercel 自動デプロイ環境構築・運用マニュアル

このドキュメントでは、ローカル開発環境（VS Code / Antigravity）から GitHub を経由して Vercel に自動デプロイする仕組みについて解説します。
一度設定を行えば、**「GitHubにプッシュするだけ」** でWebサイトが更新されるようになります。

## 1. 全体像（自動化の仕組み）

```mermaid
graph LR
    A[Local PC (VS Code)] -->|git push| B[GitHub Repository];
    B -->|Webhook Trigger| C[Vercel Cloud];
    C -->|Auto Build & Deploy| D[Live Website];
    style A fill:#f9f,stroke:#333,stroke-width:2px
    style B fill:#fff,stroke:#333,stroke-width:2px
    style C fill:#000,stroke:#fff,stroke-width:2px,color:#fff
    style D fill:#d4af37,stroke:#333,stroke-width:2px
```

## 2. 初回セットアップ手順（手動）

この手順はプロジェクトごとに **最初の1回だけ** 必要です。

### 2-1. GitHubリポジトリの作成とプッシュ
1.  ローカルプロジェクトで `git init` を実行。
2.  GitHubで空のリポジトリを作成。
3.  リモートリポジトリとして登録し、コードをプッシュします。
    ```bash
    git remote add origin https://github.com/username/repo-name.git
    git push -u origin main
    ```

### 2-2. Vercelとの連携
1.  [Vercel Dashboard](https://vercel.com/dashboard) にログイン。
2.  **[Add New Project]** をクリック。
3.  **[Import Git Repository]** から対象のGitHubリポジトリ（例: `izumo`）を探し、**[Import]** をクリック。
4.  設定画面で **[Deploy]** をクリック。
    *   静的サイト（HTML/CSS）の場合、設定変更は不要です。
    *   数十秒でデプロイが完了し、公開URLが発行されます。

---

## 3. 日々の運用（完全自動化）

初回設定完了後は、Vercelの管理画面を開く必要はありません。
**以下のコマンドを実行するだけで、数分以内に本番サイトが更新されます。**

### コマンド操作（PowerShell / Terminal）

```powershell
# 1. 変更ファイルをステージング
git add .

# 2. 変更内容を記録（メッセージはわかりやすく）
git commit -m "ヘッダーのデザインを微修正"

# 3. GitHubへ送信（これがデプロイのトリガーになります）
git push
```

### 結果確認
- `git push` が成功した時点で、Vercel側で自動的にビルドが始まります。
- 通常1分程度で、本番URL（例: `https://izumo.vercel.app`）の内容が更新されます。

## 4. トラブルシューティング

- **デプロイされない場合**
    - `git push` がエラーになっていないか確認してください。
    - Vercelダッシュボードの [Deployments] タブで、エラーログを確認できます。
- **特定のアカウントでPushできない**
    - 会社用・個人用のアカウント使い分けが必要な場合は、リモートURLにユーザー名を含めることで解決できます。
    - 例: `https://yonetaniweb@github.com/yonetaniweb/izumo.git`
