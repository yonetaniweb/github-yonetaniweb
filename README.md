# My Life OS (Obsidian Vault)

このリポジトリは、私の業務 (`Company_Work`) および個人の知識資産を統合管理する Obsidian Vault です。

## 📂 Structure

- **`.obsidian`**: 設定・プラグイン・テーマ同期用
- **`01.new`**: 新規開発・制作中のプロジェクト
- **`02.monthly-contract`**: 月額保守・運用の継続案件
- **`Knowledge_Base`**: マニュアル・技術仕様書・テンプレート（`20_Knowledge_Base`）

## 🤖 AI Configuration Files

AIエージェント向けの設定は、役割ごとに分割して管理しています。

| ファイル | 役割 |
|----------|------|
| `00_Global_Context.md` | 領域（Company/Private）の哲学・分離ルール |
| `AI_INSTRUCTIONS.md` | AIの具体的な行動ルール（保存先、報告ルールなど） |
| `README.md` | リポジトリの概要（人間向け） |

> **Note:** 分割してもAIのパフォーマンスに影響はありませんが、役割が明確に分かれているため管理しやすくなっています。

## 🚀 Sync Rules
- Work & Home PCs are synced via GitHub Private Repo.
- **Always `git pull` before starting work.**