# Dual Ecosystems & ナンバリングシステム

## 📋 概要
- **プロダクト名・案**: Dual Ecosystems Project Management
- **目的**: 業務と私生活のコンテキスト分離と、資産管理の効率化・検索性の向上
- **背景**: 以前は `Company_Work` と `Private_Life` でルートフォルダを完全に分けていたが、階層が深くなりアクセス性が悪かった。また、同じ技術スタックを使う場面で知識の共有がしづらかった。
- **解決策**: 全領域で共通の `00-99` ナンバリングを採用し、リポジトリ直下にフラットに展開する（`01.new`, `02...`）。コンテキスト（業務/私生活）は論理的に分離・管理する。
- **ゴール**: フォルダ名（番号）を見るだけで、そのプロジェクトが「新規」「保守」「知識」のどれに該当するか即座に判別でき、かつAIエージェントが迷わず適切な場所にファイルを格納できる状態。

## 🚀 手順・実装
1. **ステップ1**: フォルダ構造のフラット化
   - ルート直下に `01.new`, `02.monthly-contract` などを配置。
2. **ステップ2**: AIルールの更新
   - `AI_INSTRUCTIONS.md` に新規格のナンバリング表を定義。
   ```bash
   # 例: プロジェクトの移動
   mv old_project/ 01.new/new_project_name/
   ```

## 🧩 仕組み・構成（図解）
**Dual Ecosystems (Logical Separation, Unified Numbering)**

```
[Repository Root]
    |
    +-- 01.new/               (新規開発: Company/Private混在可)
    |     +-- Project_A/      (Company)
    |     +-- Project_B/      (Private)
    |
    +-- 02.monthly-contract/  (保守運用: Company)
    |     +-- Client_X/
    |
    +-- Knowledge_Base/       (共通資産: Shared)
    |     +-- antigravity_playbook/
    |
    +-- AI_INSTRUCTIONS.md    (憲法: 00-99ルール定義)
```

## 💡 補足・効果
- **メリット**: 階層が浅くなり、ファイルへの到達スピードが向上する。AIにとっても探索範囲が明確になる。
- **注意点**: `01.new` の中身が混在するため、プロジェクトごとの `README.md` やGit利用時に「これは業務か個人か」を意識する必要がある（Gitアカウントの使い分け等）。
