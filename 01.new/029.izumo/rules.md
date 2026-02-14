# Project Coding Rules (Izumo Renewal)

**重要**: 本プロジェクトは共通規約 `Company_Work/20_Knowledge_Base/Tech_Stack/Static_HTML/STATIC_Rules.md` に準拠します。
以下に記載する内容は、本プロジェクト固有の特別ルールであり、共通規約より優先されます。

---

## 1. フォント設定 (Font Family)

参照サイト (TCD071) のスタイルに合わせ、以下のフォントスタックを厳守してください。

### Body (本文)
- **Font Family**: `Arial`
- **Weight**: 400 (normal)
- **Size**: 14px
- **Line Height**: 20px
- **Color**: `rgb(0, 0, 0)`

```css
body {
  font-family: Arial, sans-serif;
  font-weight: 400;
  font-size: 14px;
  line-height: 20px;
  color: rgb(0, 0, 0);
}
```

### Headings (見出し)
- **Font Family**: `"Times New Roman", Times, "Yu Mincho", "游明朝", "游明朝体", "Hiragino Mincho Pro", serif`
- **Weight**: 700 (bold)
- **Size**: 32px
- **Line Height**: 38px
- **Color**: `rgb(0, 0, 0)`

```css
h1, h2, h3, h4, h5, h6, .heading-serif {
  font-family: "Times New Roman", Times, "Yu Mincho", "游明朝", "游明朝体", "Hiragino Mincho Pro", serif;
  font-weight: 700;
  font-size: 32px; /* 必要に応じて調整 (h2, h3 等でサイズ変更可) */
  line-height: 38px;
  color: rgb(0, 0, 0);
}
```

---

## 2. 配色 (Color Scheme)

- **Main Color**: TCD071デモに準拠した和風モダンな配色を採用してください。
    - *黒 (#000000)* を基調とし、アクセントに *金/朱* などを使用する場合は、デザイン生成時に指定します。

## 3. デザイン方針

- **レイアウト**: `Static_Rules.md` のユーティリティクラス (`.contents`, `.flex` 等) を使用して構築すること。
- **画像**: 和モダン・神社・風景をテーマにした高品質画像を使用する（Stitch生成）。

---

Stitch連携は `stitch_mcp_config.json` を参照。APIキー設定済み。
