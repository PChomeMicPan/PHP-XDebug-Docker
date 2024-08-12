
# PHP 單元測試環境

使用Docker來使用單元測試開發環境，並提供兩個不同版本的PHP（7.1和8.2），您可以根據需要切換使用。

### 啟動PHP 7.1 Docker容器

使用以下命令啟動Docker容器：

```bash
docker-compose up php71 --build -d
```
請確保已經安裝了Docker和Docker Compose。
### 瀏覽測試結果

啟動後，透過訪問以下網址可以查看測試結果：

 - PHP 7.1:[http://localhost:8071/index.html](http://localhost:8071/index.html)
 - PHP 8.2:[http://localhost:8082/index.html](http://localhost:8082/index.html)

### 進入Docker容器

你可以使用以下命令進入Docker容器：

```bash
docker-compose exec -it php71 bash
```

### 執行單元測試

你可以使用以下命令生成測試結果：

```bash
vendor/bin/phpunit --coverage-html ./test-result  --process-isolation
```
