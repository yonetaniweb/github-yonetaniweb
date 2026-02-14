# Web-Yonet ブログ生成プロジェクト

## 概要
web-yonet.jp のブログ記事を、原稿ファイル(.txt)からWordPressブロックエディター形式のコードに変換するプロジェクト。

---

## プロジェクト情報

| 項目 | 内容 |
|------|------|
| サイトURL | https://web-yonet.jp/category/blog |
| テーマ | Stork19 |
| 担当AI | Antigravity |
| ワークフロー | `/web-yonet-blog` |

---

## フォルダ構成

```
web-yonet-blog/
├── 00_Project_Dashboard.md   ← このファイル
├── input/                     ← 記事にしたい原稿を.txtで配置
│   └── processed/             ← 処理済みファイル移動先
├── output/                    ← 変換後のHTMLコード出力先
└── templates/
    └── block-patterns.md      ← Stork19ブロック構造見本
```

---

## 使い方

### 1. 原稿を準備
- `input/` フォルダに記事にしたい内容を `.txt` ファイルで保存

### 2. チャットで依頼
```
web-yonetのブログを作成お願いします
```

### 3. 成果物を受け取る
- `output/` フォルダに `2026-02-09_ファイル名.html` 形式で出力される
- WordPressのコードエディターにそのままコピペ可能

---

## 出力構成ルール

1. **導入** - サイト運営者さまの吹き出しで読者の悩みを提示
2. **記事の価値提示** - タイトル付きBOXで「この記事で解決できること」
3. **本文** - H2/H3見出し、段落、画像、リスト、よねってぃの吹き出し
4. **まとめ** - タイトル付きBOXで「本日のまとめ」
5. **FAQ** - アコーディオン形式で2〜3個

---

## 固有ルール・NGワード

- 文体: 専門的な内容を初心者に語りかける親しみやすい口調
- 重要キーワード: `<span class="pre--maker span-stk-maker-yellow"><strong>マーカー</strong></span>` で強調
- ブロック構造: `templates/block-patterns.md` 参照
