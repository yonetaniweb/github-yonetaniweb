# プロジェクト運用ルール (30_Projects)

このフォルダは、**新規クライアント案件**の作業場所です。
過去の参考コードは `20_Knowledge_Base/Tech_Stack` にあります。

---

## 📁 ディレクトリ構造

新規プロジェクトは以下の共通構造に従います。

```
[Project_Name]/
├── 01_Design/          # デザインファイル (PSD, AI, FIG, PDF等)
├── 02_Static_HTML/     # 静的コーディングファイル (HTML/CSS/JS)
├── 03_WordPress/       # WordPressテーマファイル (PHP等)
├── 04_LP/              # ランディングページ用ファイル
└── 99_Deliverables/    # 最終納品物 (zip, 提出用資料等)
```

---

## 🚀 新規プロジェクトの始め方

### 1. フォルダ作成
この `30_Projects` 直下に、新しいプロジェクト名のフォルダ（例: `New_Client`）を作成します。

### 2. サブフォルダ作成
上記の「ディレクトリ構造」に従って、必要な空フォルダ（`01_Design`, `02_Static_HTML` 等）を作成します。

### 3. デザイン格納
`01_Design` にデザインカンプを入れます。

### 4. AIへの指示出し
AI（Antigravity）に対して、参考資料を指定して指示します。

**例：WordPressテーマを作る場合**
> 「`Tech_Stack/WordPress/00_Master_Theme` の構造に従い、必要なら `Examples/shoei` を参考にして、このデザインでWPテーマを作成して」

**例：静的サイトを作る場合**
> 「`Tech_Stack/Static_HTML/shoei` を参考にして、このデザインでコーディングして」

**例：LPを作る場合**
> 「`Tech_Stack/LP/tenhiko` を参考にして、このデザインでLPを作成して」

---

## 📚 参考コードの場所

過去の実装例は `20_Knowledge_Base/Tech_Stack/` にあります。

| 種類 | 場所 |
|------|------|
| ⭐ WP正解テンプレート | `Tech_Stack/WordPress/00_Master_Theme/` |
| WP実装例 | `Tech_Stack/WordPress/Examples/` |
| 静的サイト例 | `Tech_Stack/Static_HTML/` |
| LP例 | `Tech_Stack/LP/` |

詳細は `Tech_Stack/README.md` をご覧ください。

---

## ⚠️ 禁止事項

- **参考コードの直接編集**: `Tech_Stack` 内のファイルを新しい案件のために書き換えないでください。
- **ゴミファイルの放置**: テストで作った `verify.py` や `debug.log` などは、用が済んだら削除してください。

---

## 💬 AIへの具体的な指示例（プロンプト集）

新規プロジェクトを開始する際、以下のようにAIに指示してください。

### パターン1: WordPressテーマを作成する場合
```
Tech_Stack/WordPress/00_Master_Theme の構造に従い、
必要なら Examples/shoei を参考にして、
このデザイン（01_Design/）でWPテーマを作成してください。
```

### パターン2: 静的サイトをコーディングする場合
```
Tech_Stack/Static_HTML/shoei を参考にして、
このデザイン（01_Design/）で静的サイトをコーディングしてください。
出力先は 02_Static_HTML/ です。
```

### パターン3: LPを作成する場合
```
Tech_Stack/LP/tenhiko を参考にして、
このデザイン（01_Design/）でLPを作成してください。
出力先は 04_LP/ です。
```

### パターン4: 静的サイトをWP化する場合
```
02_Static_HTML/ の静的サイトを、
Tech_Stack/WordPress/00_Master_Theme の構造に従って
WordPressテーマ化してください。
出力先は 03_WordPress/ です。
```

---

## 📋 標準的なプロジェクトフロー

1. **デザイン受領** → `01_Design/` に格納
2. **静的コーディング** → AIに指示して `02_Static_HTML/` に生成
3. **WPテーマ化**（必要な場合）→ AIに指示して `03_WordPress/` に生成
4. **納品準備** → 完成物を `99_Deliverables/` にzip等で格納
