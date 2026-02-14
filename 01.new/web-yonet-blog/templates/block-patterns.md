# Stork19 ブロックパターン集

web-yonet.jp ブログ記事で使用するWordPressブロックの構造見本です。
コード生成時は、必ずこの構造を維持してください。

---

## H2見出し

```html
<!-- wp:heading {"textAlign":"center","className":"is-style-style__section_ttl__border_under"} -->
<h2 class="wp-block-heading has-text-align-center is-style-style__section_ttl__border_under">ここにH2見出しが入ります</h2>
<!-- /wp:heading -->
```

---

## H3見出し

```html
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">ここにH3見出しが入ります</h3>
<!-- /wp:heading -->
```

---

## 段落

```html
<!-- wp:paragraph -->
<p>ここに段落が入ります。重要なキーワードには<span class="pre--maker span-stk-maker-yellow"><strong>マーカーと太字</strong></span>を引きます。</p>
<!-- /wp:paragraph -->
```

---

## 画像

```html
<!-- wp:image {"id":12109,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://...画像URL..." alt="画像の説明" class="wp-image-12109"/></figure>
<!-- /wp:image -->
```

---

## リスト（箇条書き）

```html
<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>リスト項目1</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li>リスト項目2</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
```

---

## 吹き出し（サイト運営者さま）

```html
<!-- wp:stk-plugin/voicecomment {"avatarUrl":"https://web-yonet.jp/wp-content/uploads/2025/10/26542107_2.png","avatarId":996,"name":"サイト運営者さま"} -->
<div class="wp-block-stk-plugin-voicecomment voice default l icon_default"><figure class="icon"><img class="voice_icon__img" src="https://web-yonet.jp/wp-content/uploads/2025/10/26542107_2.png" width="100" height="100" alt=""/><figcaption class="avatar-name name">サイト運営者さま</figcaption></figure><div class="voicecomment"><!-- wp:paragraph -->
<p>ここにセリフが入ります。</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:stk-plugin/voicecomment -->
```

---

## 吹き出し（よねってぃ）

```html
<!-- wp:stk-plugin/voicecomment {"avatarUrl":"https://web-yonet.jp/wp-content/uploads/2025/08/yonety-fukidashi_2.png","avatarId":406,"name":"よねってぃ"} -->
<div class="wp-block-stk-plugin-voicecomment voice default l icon_default"><figure class="icon"><img class="voice_icon__img" src="https://web-yonet.jp/wp-content/uploads/2025/08/yonety-fukidashi_2.png" width="100" height="100" alt=""/><figcaption class="avatar-name name">よねってぃ</figcaption></figure><div class="voicecomment"><!-- wp:paragraph -->
<p>ここにセリフが入ります。</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:stk-plugin/voicecomment -->
```

---

## タイトル付きBOX

```html
<!-- wp:stk-plugin/cbox {"cboxtitle":"ここにタイトルが入ります"} -->
<div class="wp-block-stk-plugin-cbox cbox intitle is-style-site_color type_normal"><div class="box_title"><span class="span__box_title">ここにタイトルが入ります</span></div><div class="cboxcomment"><!-- wp:paragraph -->
<p>ここに説明文が入ります。</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:stk-plugin/cbox -->
```

---

## FAQ（アコーディオン）

```html
<!-- wp:stk-plugin/faq-accordion {"faqtitle":"ここに質問が入ります。","labelID":"ユニークなID"} -->
<div class="oc-faq faq-icon--border faq-icon--radius_kadomaru"><input type="checkbox" id="ユニークなID" class="accordion_check"/><label class="oc-faq__title faq__label" for="ユニークなID">ここに質問が入ります。</label><div class="oc-faq__comment"><!-- wp:paragraph -->
<p>ここに回答が入ります。</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:stk-plugin/faq-accordion -->
```

---

## 構成順序

記事は以下の順序で構成すること：

1. **導入** - 吹き出し（サイト運営者さま）で読者の悩みを提示
2. **価値提示** - タイトル付きBOX「この記事で解決できること」＋リスト
3. **本文** - H2/H3、段落、画像、リスト、吹き出し（よねってぃ）
4. **まとめ** - タイトル付きBOX「本日のまとめ」＋リスト
5. **FAQ** - アコーディオンで2〜3個
