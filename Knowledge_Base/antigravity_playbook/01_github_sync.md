# GitHub同期セットアップガイド

複数のPC（自宅・職場）で同じVaultを使うための仕組みです。
GitHubを経由して、自動的にファイルを同期します。

---

## 🧩 仕組みの全体像

```
自宅PC ──push──▶ GitHub ◀──pull── 職場PC
   ▲                                  ▲
   └── VS Code を閉じると自動push     └── VS Code を開くと自動pull
```

> 💡 手動でgitコマンドを打つ必要はありません。
> **GitDoc拡張機能**が保存・終了時に自動で同期します。
> ランチャー（`.bat`ファイル）を使う方法もあります。

---

## 📋 事前準備

以下のツールがインストールされていることを確認してください。

| ツール | 用途 | ダウンロード |
|--------|------|-------------|
| **Git** | ファイル同期の基盤 | [git-scm.com](https://git-scm.com/) |
| **VS Code** | エディタ本体 | [code.visualstudio.com](https://code.visualstudio.com/) |
| **Antigravity拡張** | AIアシスタント | VS Code内で検索してインストール |
| **GitDoc拡張** | Git自動同期 | 下記「GitDocセットアップ」参照 |

---

## 🚀 初回セットアップ（1台目のPC）

### Step 1: GitHubにリポジトリを作成

1. [github.com](https://github.com) を開く
2. 右上の「**+**」→「**New repository**」をクリック
3. 以下の設定で作成する

| 項目 | 設定値 |
|------|--------|
| Repository name | 好きな名前（例: `My_Antigravity_System`） |
| Visibility | **Private**（非公開） |
| Initialize | チェックを**入れない** |

4. 「**Create repository**」をクリック

### Step 2: ローカルのVaultをGitHubに接続

ターミナル（VS Code内のターミナルでOK）を開いて、以下を順番に実行します。

```bash
cd "Vaultのフォルダパス"
```

> 💡 例: `cd "C:\Users\hagih\Documents\Obsidian_Vault"`

```bash
git init
git remote add origin https://github.com/ユーザー名/リポジトリ名.git
```

### Step 3: 初回コミット & プッシュ

```bash
git add -A
git commit -m "Initial commit"
git branch -M main
git push -u origin main
```

> ⚠️ この時点でGitHubの認証画面が表示されます。
> 詳しくは下の「認証について」を確認してください。

---

## 🔐 認証について

初回接続時に、**2つの認証画面**が表示されます。
**どちらも正当なもの**です。両方「**Authorize**」を押してOKです。

| 画面 | 何の認証？ | いつ出る？ |
|------|-----------|-----------|
| **Git Credential Manager** | gitコマンド用の認証 | ターミナルでGitHubにアクセスしたとき |
| **Google Antigravity** | VS Code拡張用の認証 | VS Code経由でGitHub操作したとき |

> 💡 2回認証するのは正常です。
> 1回目はGitコマンド用、2回目はVS Codeの拡張用です。

---

## 🔄 自動同期の使い方

### 方法1: GitDoc拡張機能 ⭐推奨（現在の設定）

**GitDoc** 拡張機能により、**VS Codeをどんな方法で起動しても自動同期**されます。
ランチャー不要で、VS Codeを普通に開くだけでOKです。

| タイミング | 動作 |
|-----------|------|
| **VS Code を開いたとき** | 自動で `git pull`（最新を取得） |
| **ファイル保存から30秒後** | 自動で `git commit`（変更を記録） |
| **コミット直後** | 自動で `git push`（GitHubにアップロード） |
| **VS Code を閉じたとき** | 自動で `git commit` & `push`（最終同期） |

#### GitDoc インストール手順

VS Codeのターミナルで以下を実行：

```bash
code --install-extension vsls-contrib.gitdoc
```

または、VS Code内で `Ctrl+Shift+X` → `GitDoc` で検索してインストール。

#### GitDoc 設定内容（`.vscode/settings.json`）

```json
{
    "gitdoc.enabled": true,
    "gitdoc.autoPush": "onCommit",
    "gitdoc.commitOnClose": true,
    "gitdoc.commitMessageFormat": "Auto-sync: {date}",
    "gitdoc.autoCommitDelay": 30000,
    "gitdoc.pullOnOpen": true,
    "git.enableSmartCommit": true,
    "git.autofetch": true
}
```

| 設定項目 | 値 | 説明 |
|---------|-----|------|
| `gitdoc.enabled` | `true` | GitDoc機能を有効化 |
| `gitdoc.autoPush` | `"onCommit"` | コミット直後に自動プッシュ |
| `gitdoc.commitOnClose` | `true` | VS Code終了時に自動コミット |
| `gitdoc.autoCommitDelay` | `30000` | 保存から30秒後に自動コミット |
| `gitdoc.pullOnOpen` | `true` | 起動時に自動プル |

> 💡 この設定ファイルはGitHubに含まれるので、2台目のPCではGitDoc拡張機能をインストールするだけでOKです。

---

### 方法2: ランチャースクリプト（代替方法）

GitDocが使えない環境では、バッチファイルから起動する方法もあります。

**ファイルの場所:**
```
.vscode/scripts/Antigravity_AutoSync.bat
```

**使い方:**

1. このファイルを**ダブルクリック**する
2. 自動で `git pull`（最新を取得）が実行される
3. VS Code が開く → 普通に作業する
4. VS Code を**閉じる** → 自動で `git commit & push` が実行される

> 💡 **ショートカットを作ると便利です！**
> ファイルを右クリック → 「**送る**」→ 「**デスクトップ（ショートカットを作成）**」

---

## 💻 2台目PC（職場など）のセットアップ

### Step 1: Gitをインストール

[git-scm.com](https://git-scm.com/) からダウンロードしてインストールします。

> 💡 インストール時の設定はすべてデフォルトのままでOKです。

### Step 2: リポジトリをクローン

ターミナルを開いて、以下を実行します。

```bash
git clone https://github.com/ユーザー名/リポジトリ名.git
```

> 💡 例: `git clone https://github.com/hagihiro100/My_Antigravity_System.git`

クローンが完了すると、全ファイル（設定ファイル含む）がダウンロードされます。

### Step 3: GitDoc拡張機能をインストール

VS Codeのターミナルで以下を実行します：

```bash
code --install-extension vsls-contrib.gitdoc
```

> 💡 `.vscode/settings.json`（GitDocの設定）はクローンに含まれているので、拡張機能をインストールするだけで自動同期が有効になります。

### Step 4: VS Codeで開く

1. クローンしたフォルダをVS Codeで開く
2. 認証画面が出たら「**Authorize**」をクリック
3. GitDocが自動的に同期を開始します

> ✅ これで自宅PCと同じ環境が使えます！
> タスクバーやアイコンから普通にVS Codeを開くだけでOKです。

---

## � 既存フォルダの取り込み（ローカル → GitHub）

すでにPC上にあるフォルダ（例: 職場で作成したデータ）をGit同期に組み込みたい場合の手順です。

### ケース: 「ローカルのフォルダが正解」で上書きしたい場合

```
GitHub上のVault                  職場PC（ローカル）
┌──────────────────┐          ┌──────────────────┐
│ Company_Work/    │          │ Company_Work/    │
│   (古い or 空)   │  ←上書き  │   (最新・正解)    │
└──────────────────┘          └──────────────────┘
```

#### 手順

1. **GitHubからクローン**（まだの場合）
   ```bash
   git clone https://github.com/hagihiro100/My_Antigravity_System.git
   ```

2. **ローカルのフォルダを上書きコピー**
   - クローンしたフォルダに、正解のフォルダを**上書きコピー**する
   - 同名ファイルは「上書き」を選ぶ（ローカルが正解なので）

3. **GitDocをインストール**（まだの場合）
   ```bash
   code --install-extension vsls-contrib.gitdoc
   ```

4. **VS Codeで開く**
   - GitDocが自動的に変更を検出 → コミット → プッシュしてくれます

5. **もう1台のPCで確認**
   - VS Codeを開くと自動で `git pull` → 取り込んだフォルダが反映されます

> ⚠️ **注意**: 上書きするとGitHub上の古いバージョンは消えます。
> 念のため確認したい場合は、コピー前にクローンの中身を見比べてください。
> ただし**Gitの履歴から過去のバージョンは復元可能**なので、安心してください。

## �🔧 自動同期スクリプトの中身

### Antigravity_AutoSync.bat

VS Codeを自動同期モードで起動するためのラッパーです。

```bat
@echo off
REM ダブルクリックで VS Code を開き、閉じたら自動で GitHub に Push します
powershell -ExecutionPolicy Bypass -File "%~dp0auto-sync.ps1"
```

### auto-sync.ps1

実際の同期処理を行うPowerShellスクリプトです。

| フェーズ | 処理内容 |
|----------|---------|
| **起動時** | `git pull origin main`（最新を取得） |
| **作業中** | VS Codeが開いている間は待機 |
| **終了時** | 変更があれば `git add -A` → `git commit` → `git push` |

> 💡 コミットメッセージは `Auto-sync: 2026-02-11 08:30` のように自動生成されます。

---

## 🏢 職場・マルチアカウントでの運用ルール (Multi-Account)

「個人のバックアップ」と「職場のプロジェクト」を同一Vault内で安全に管理するためのルールです。

### 1. 鉄の掟：Ignore分離の原則

職場のプロジェクト（独自のGitリポジトリを持つもの）を、個人のバックアップに巻き込んではいけません。
**必ず「親（個人）」が「子（職場）」を無視する設定**を行ってください。

#### 手順
1. Vaultルートにある `.gitignore` ファイルを開く。
2. 職場プロジェクトのパスを追記する。

```gitignore
Company_Work/30_Projects/案件名/
```

### 2. 職場用リポジトリの独立設定

Ignoreされたフォルダ内では、自由に `git init` して職場用のアカウントを設定できます。

```bash
# 職場プロジェクト内で実行
git config user.name "Your Work Name"
git config user.email "your.work@email.com"
```

これにより、VS Codeのソース管理画面には「個人用」と「職場用」の2つのリポジトリが表示され、**お互いに干渉することなく同時に**使えます。

---

## ❓ トラブルシューティング

### 「git is not recognized」と表示される

**原因:** Gitがインストールされていない、またはPATHに追加されていない。

**対処:**
1. [git-scm.com](https://git-scm.com/) からGitをインストール
2. インストール時に「**Add Git to PATH**」にチェックが入っていることを確認
3. ターミナルを**再起動**する

### `git pull` で競合（conflict）が発生する

**原因:** 2台のPCで同じファイルを同時に編集した。

**対処:**
1. VS Codeで競合ファイルを開く
2. `<<<<<<< HEAD` と `>>>>>>> main` で囲まれた部分を確認
3. 残したい方の内容を選ぶ（または手動で統合する）
4. ファイルを保存して再度コミット＆プッシュ

> 💡 **競合を防ぐコツ:** 作業を始める前に必ず `git pull`（ランチャーなら自動）を実行すること。

### 認証画面が何度も出る

**対処:**
1. Git Credential Managerが最新かを確認（`git --version` で2.39以降を推奨）
2. Windowsの「資格情報マネージャー」で古いGitHub認証を削除して再認証

### 認証画面が出ずに同期（Push）が止まる

**現象:** VS Code内のターミナルで `git push` しても反応がなく、認証画面も出ずに永遠に待機状態になる。

**原因:** VS Codeの認証ヘルパー（Git Credential Manager）がバックグラウンドでポップアップを出そうとして失敗している、または既存のプロセスがゾンビ化している。

**解決策:** Antigravity（VS Code）の外にある「PowerShell」から直接コマンドを入力して実行する。AIからのコマンド実行ではなく、ユーザー自身が入力することで認証ダイアログが正しく表示される。

1. `Ctrl + @` キーを押して、VS Codeの下部にパネルを開く。
2. 「ターミナル」タブを選択し、右上の「＋」の横にある矢印から **「PowerShell」** を選ぶ。
3. 画面下の黒い部分をクリックしてカーソルを合わせる。
4. 以下のコマンドをコピー＆ペーストして Enter キーを押す。

```powershell
git push origin main
```

（もし `git merge master --no-edit` が必要な場合は、それを先に実行する）

5. ブラウザが起動してGitHubの認証画面が表示されるか、コマンドラインにパスワード入力を求められるので、指示に従って認証する。

> 💡 一度この方法で認証を通せば、以降は自動同期（GitDoc）も正常に動作するようになります。

### 「Everything up-to-date」なのに変更が反映されない

**現象:**  
`git push` を実行しても "Everything up-to-date" と表示され、GitHubに変更が反映されない。
しかし、VS Code上ではファイルの変更があり、同期マークがくるくる回っている。

**原因:**  
「まだ荷造り（コミット）」が終わっていないためです。
ステージされている変更（送りたいファイル）があっても、コミット（箱詰め）されていないと、`git push`（配送）しても「運ぶ箱がないよ（Up-to-date）」と判断されます。

**解決手順（手動で完了させる）:**

1. **メッセージを入力する**  
   VS Code左側の「ソース管理」パネル（枝分かれアイコン）にある入力欄（「メッセージ (Ctrl+Enterで...」の場所）に、何か一言入力してください（例：「update」など）。

2. **「コミット」ボタンを押す**  
   メッセージを入れたら、その下の青い **「コミット」** ボタンを押します。
   これでファイルが「箱詰め」されます。

3. **「変更の同期」ボタンを押す**  
   コミットが完了すると、ボタンが **「変更の同期」**（または上矢印のアイコン）に変わります。これをクリックしてください。
   これではじめて、GitHubへデータが送信されます。

> 💡 **GitDocについて:** GitDocなどの自動化ツールは、ブランチの切り替えなどの大きな操作をした直後は、安全のために自動動作を停止することがあります。一度手動同期すれば、次回からはまた自動で動くようになります。

---

## 🤖 GitDoc（自動同期）の詳細仕様

GitDocは、「コミット」も「プッシュ」も「プル」もすべて全自動で行います。

> "Automatically commit/push/pull changes on save"

### 設定内容（`.vscode/settings.json`）

| 設定 | 値 | 意味 |
|------|-----|------|
| `gitdoc.autoPull` | afterDelay (30秒) | GitHubから自動ダウンロード |
| `gitdoc.autoPush` | afterDelay (30秒) | GitHubへ自動アップロード |
| `gitdoc.commitMessageFormat` | Update: ${date} ${time} | 自動コミットメッセージの形式 |
| `gitdoc.enabled` | true | 有効 |

つまり、ファイルを保存するたびに以下の3つを全自動で実行します：

1. **自動コミット**（PCに保存）
2. **30秒後に自動プッシュ**（GitHubにアップロード）
3. **30秒後に自動プル**（GitHubからダウンロード）

### 認証が切れた場合
プッシュ（アップロード）だけが失敗しますが、認証さえ通っていれば何もしなくても勝手にGitHubに反映されます。

### 手動で確実にプッシュしたい場合
今後もし自動同期が動かない場合は、画面下の PowerShell に以下を入力するだけでOKです：

```powershell
git add -A; git commit -m "update"; git push origin main
```

または、AIに「同期して」と言えば、上記のコマンドを表示しますので、それをPowerShellにコピペしてください。
---

## 📂 .gitignore について

GitHubに同期**しない**ファイルは `.gitignore` で管理されています。

| 除外対象 | 理由 |
|----------|------|
| `auto_accounting/` | ローカル専用の経理データ |
| `.vscode/` の一部 | PC固有の設定 |
| `.obsidian/workspace*` | ウィンドウ配置の個人設定 |

> 💡 `.gitignore` はVaultのルートにあります。
> 新しく除外したいファイルがあれば、ここに追記します。

---

## 🔧 設定画面 (UI) からの設定確認・修正手順

JSONファイルを直接編集するのが難しい場合は、VS Codeの設定画面（UI）からも変更できます。

1. **設定画面を開く**
   - `F1` キーを押して、入力欄に `open settings ui` と入力し、「**基本設定: 設定 (UI) を開く**」を選びます。

2. **GitDoc設定を検索**
   - 設定画面の検索バーに `gitdoc` と入力します。

3. **設定項目の確認と修正**

   **① Gitdoc: Auto Push**
   - `afterDelay`（または `onCommit`）に変更してください。
   - これで、Antigravity上でも自動同期が動くようになります！

   **② Gitdoc: Enabled**
   - これが「自動コミット機能」の主電源です。
   - チェックボックスが外れている場合は、クリックして **ON（チェックが入った状態）** にしてください。
     - (注: `Gitdoc > Ai: Enabled` ではありません。単なる `Gitdoc: Enabled` です)

   **③ Gitdoc: Auto Commit Delay**
   - デフォルトが `30000`（30秒）の場合、長すぎて反応がないように見えることがあります。
   - `3000`（3秒）または `5000`（5秒）に書き換えると、スムーズに同期されます。

**まとめ：これらを直せば完璧です！**
- [x] `Gitdoc: Enabled` にチェックを入れる ✅
- [x] `Auto Commit Delay` を `3000` にする ⏱️

