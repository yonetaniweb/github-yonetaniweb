# Remotion 動画制作環境のセットアップ

Antigravityを使って高品質な動画をプログラムで生成する「Remotion」の環境構築と運用手順です。

---

## 🏗️ 1. 環境構築 (Setup)

### ケースA: 最初のPC (現在のPC)

ターミナルで以下のコマンドを実行し、RemotionとAIスキルをインストールします。

```bash
# 1. Remotionスキルのインストール (AIに知識を与える)
# ※ .agent/skills/remotion-dev_skills/ が作成されます
npx skills add remotion-dev/skills

# 2. FFmpegのインストール (動画書き出しに必須)
# Windowsの場合は choco や winget でインストール推奨
winget install Gyan.FFmpeg
```

### ケースB: 個人PC (2台目以降)

ObsidianでVaultを同期している場合、**AIスキル (`.agent/skills/`) は自動的に同期されるため、再インストールの必要はありません。**

ただし、動画生成に必要な以下のツールは**PCごとにインストール**が必要です。

1.  **Node.js の確認**: `node -v` でバージョンが表示されるか確認。なければインストール。
2.  **FFmpeg のインストール**:
    ```bash
    winget install Gyan.FFmpeg
    ```

---

## 📂 2. テンプレート管理 (Template Management)

職場・個人で共通利用するテンプレートは `Private_Life/20_Knowledge_Base/remotion_templates/` で一元管理します。

### フォルダ構成
```
remotion_templates/
├── community/  ← ネットで見つけた公開テンプレート (読み取り専用)
└── custom/     ← 自分で作ったオリジナルテンプレート (資産)
```

### 運用フロー
1.  **テンプレートを選ぶ**: `remotion_templates/README.md` の一覧から選ぶ。
2.  **コピーする**: 案件フォルダ (`30_Projects/案件名/`) にテンプレートをコピーする。
3.  **編集する**: コピー先で自由にカスタマイズする。

---

## 🚀 3. 新規プロジェクトの始め方 (How to Start)

新しい動画案件を始める場合の手順です。

### ケースA: 公式テンプレートから始める

```bash
cd Company_Work/30_Projects/
npx create-video@latest 案件名 --template hello-world
```
- セットアップ時に「**Add Antigravity Agent Skills?**」と聞かれたら **Yes** を選択（念のため）。

### ケースB: 保存したテンプレートを使う

1.  `Private_Life/20_Knowledge_Base/remotion_templates/custom/` から好きなテンプレートフォルダをコピー。
2.  `Company_Work/30_Projects/` に貼り付け。
3.  フォルダ名を案件名に変更（例: `Product_Promo_Video`）。
4.  VS Codeで開き、`npm install` を実行。

---

## 🤖 4. AIへの指示出し (Prompting)

Antigravityに動画を作らせる際のプロンプト例です。

### 良い指示の例
> 「`remotion-dev_skills` を使って、3秒のカウントダウン動画を作って。背景は黒、数字は白で、1秒ごとにズームインするアニメーションをつけて。」

### ポイント
- **スキルを明示**: 「`remotion-dev_skills` を使って」と言うと、AIがベストプラクティスを参照します。
- **具体的に**: 秒数、色、動きを指定すると精度が上がります。
