# Web制作・管理ワークフローとフォルダ構成

## 📋 概要
- **プロダクト名・案**: Web Production Workflow (New & Monthly)
- **目的**: 案件の種類（「新規制作」か「月額保守」か）に応じて、作業場所と運用ルールを明確化し、管理コストを削減する。
- **背景**: 以前は案件が混在しており、進捗把握や保守契約への切り替えが煩雑だった。
- **解決策**: ディレクトリを `01.new` と `02.monthly-contract` に完全に分離する。
- **ゴール**: フォルダを開く必要なく、ディレクトリ名だけで「今行うべきアクション（開発or保守）」が判断できる状態。

## 🚀 手順・実装
### 1. 新規案件の開始
1. `01.new/` 内にプロジェクトフォルダを作成する。
2. 開発・テスト・納品までを進める。

### 2. 保守契約への移行
1. 納品後、月額保守契約を結んだ案件のみ `02.monthly-contract/` へ移動する。
   ```bash
   mv 01.new/client_A 02.monthly-contract/client_A
   ```
2. 定期更新や緊急対応は `02` 内で行う。

## 🧩 仕組み・構成（図解）
**Web Production Structure**

```
[Repository Root]
    |
    +-- 01.new/               (制作中・スポット案件)
    |     +-- Project_A/      (Coding Phase)
    |     +-- Project_B/      (Design Phase)
    |
    +-- 02.monthly-contract/  (保守契約中)
    |     +-- Client_X/       (Maintenance)
    |     +-- Client_Y/       (Update Requests)
    |
    +-- Knowledge_Base/       (共通ナレッジ)
    |     +-- antigravity_playbook/
```

## 💡 補足・効果
- **メリット**: 「制作フェーズ」と「安定フェーズ」が完全に分かれるため、リソース配分の意識切り替えが容易になる。
- **注意点**: `01.new` から `02...` への移行漏れがないように、納品完了時に必ず移動を行うこと。
