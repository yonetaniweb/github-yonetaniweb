---
created: 2026-02-12
tags:
  - Antigravity
  - ClaudeCode
  - Remotion
  - Manual
---

# Antigravity/AI Tool Installation Manual

このマニュアルでは、Antigravity環境を強化するためのAIツール（Claude Code, Remotion Skills）のインストール方法と、複数PC間での同期・セットアップ手順について解説します。

## 1. Claude Code のインストール

Claude Codeは、ターミナルから直接AIエージェントを呼び出せる強力なツールです。
「CLI版（本体）」と「VS Code拡張機能（GUI）」の2つをインストールすることで、最強の環境が整います。

### 手順

#### ① CLI版（本体）のインストール
Antigravityのターミナル（PowerShell）を開き、以下のコマンドを実行します。

```powershell
irm https://claude.ai/install.ps1 | iex
```

インストール後、一度ターミナルを再起動するか、指示に従ってパスを通してください。
認証画面が出た場合は、ブラウザでログインして承認を行ってください。

#### ② VS Code拡張機能のインストール
VS Code上で以下のコマンドを実行するか、拡張機能マーケットプレイスからインストールします。

```bash
code --install-extension Anthropic.claude-code
```
拡張機能ID: `Anthropic.claude-code`

---

## 2. Remotion Agent Skills のインストール

動画生成フレームワーク Remotion のAI開発支援スキル（`.cursorrules` など）をプロジェクトに追加します。

### 手順
プロジェクトのルートディレクトリで以下のコマンドを実行します。

```bash
npx skills add remotion-dev/skills
```

これにより、`.cursorrules` ファイルなどが生成され、AIエージェントがRemotionのコードを理解しやすくなります。

---

## 3. 自宅PC（別環境）でのセットアップ手順

**重要:**
これらのツール（Claude CLI, VS Code拡張機能）は、PC本体（OS）やエディタにインストールされるものです。
**DropboxやGitHubでフォルダを同期しただけでは、自宅PCでは使えません。**

自宅PCでも快適に作業するために、以下の手順を行ってください。

1. **GitHubからリポジトリを同期（Pull）する**
   - ファイル自体の変更（`.cursorrules` など）はこれで反映されます。

2. **自宅PCでもインストールコマンドを実行する**
   - 会社PCで行ったのと同様に、**自宅PCのターミナルでも** 上記「1. Claude Code」と「2. Remotion Agent Skills」の手順を実行してください。
   - ※Remotion Skillsはプロジェクトごとなので、同期されていれば再実行不要な場合もありますが、Claude Code（本体・拡張機能）は必ずインストールが必要です。

3. **認証を行う**
   - Claude Codeの初回起動時に認証が求められますので、会社PCと同様にログインしてください。

これで、どのPCでも同じAI開発体験が可能になります。
