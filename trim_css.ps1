$f = "c:\Users\ARDHI\Downloads\group-3-crud-laravel\resources\css\app.css"
$lines = [System.IO.File]::ReadAllLines($f, [System.Text.Encoding]::UTF8)
$kept = $lines[0..1464] -join "`n"
[System.IO.File]::WriteAllText($f, $kept + "`n", [System.Text.Encoding]::UTF8)
Write-Output "Done. Lines kept: 1465"
