# AntigravityでGitが認識されない場合の対処法

自宅PCや新しい環境で「PowerShellではGitが使えるのに、Antigravity（エディター）上ではGitコマンドが動かない」という現象が起きた場合の対応マニュアルです。

## 原因
Antigravityの設定ファイルで、`git.exe` の場所が正しく指定されていない、またはデフォルトのターミナルが「Command Prompt」になっていることが原因です。

## 解決手順

### 1. Gitのインストール場所を確認する
PowerShellを開き、以下のコマンドを入力して実際のパスを確認します。
```powershell
Get-Command git | Select-Object -ExpandProperty Source
```
出力例: `C:\Program Files\Git\bin\git.exe`
※このパスをコピーしておきます。

### 2. Antigravityの設定ファイルを開く
1. Antigravityの画面左下にある歯車アイコン ⚙️ をクリックし、**Settings** を選択（または `Ctrl + ,`）。
2. 設定画面の右上のアイコン（Open Settings (JSON)）をクリックして、`settings.json` ファイルを直接開きます。
3. もしくは、ファイルパスを直接開きます:
   `%APPDATA%\Antigravity\User\settings.json`

### 3. 設定を追加・修正する
`settings.json` の `{ ... }` の中に、以下の2行を追加（または修正）します。
パスの `\` は `\\` にエスケープする必要がある点に注意してください。

```json
{
    // ... 他の設定 ...
    
    // 1. Gitのパスを明示的に指定
    "git.path": "C:\\Program Files\\Git\\bin\\git.exe",

    // 2. ターミナルをPowerShellに変更
    "terminal.integrated.defaultProfile.windows": "PowerShell",

    // ... 他の設定 ...
}
```

### 4. 再起動
設定ファイルを保存(`Ctrl + S`)した後、Antigravityを再起動します。
ターミナルで `git --version` を実行し、バージョンが表示されれば成功です。
