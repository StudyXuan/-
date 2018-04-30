<?php
//在实例化对象之前必须添加php-redis拓展
$redis = new Redis();
//在链接之前必须开启redis服务
$redis->connect('127.0.0.1', 6379);
echo "Server is running: ".$redis->ping()."<br/>";
//string
$redis->set('cat','111');
echo $redis->get('cat')."<br/>";
//list
$redis->lpush('list','html');
$redis->lpush('list','css');
$redis->lpush('list','php');
print_r($redis->lrange('list',0,-1));
echo "<br/>";
//hash
$redis->hset('hash','cat','cat');
$redis->hset('hash','dog','dog');
$redis->hset('hash','bird','bird');
$redis->hset('hash','monkey','monkey');
echo $redis->hget('hash','cat')."<br/>";
print_r($redis->hkeys('hash'));
echo "<br/>";
//无序集合
$redis->sadd('set','cat');
$redis->sadd('set','cat');
$redis->sadd('set','dog');
$redis->sadd('set','rabbit');
$redis->sadd('set','bear');
$redis->sadd('set','horse');
$redis->sadd('set','cat');
print_r($redis->smembers('set'));
echo "<br/>";
//有序集合
//重复的不会加入集合，但是会重置顺序
$redis->zadd('zset',1,'cat');
$redis->zadd('zset',2,'dog');
$redis->zadd('zset',3,'fish');
$redis->zadd('zset',4,'monkey');
$redis->zadd('zset',5,'bird');
$redis->zadd('zset',6,'cat');
$redis->zadd('zset',7,'cat');
$redis->zadd('zset',8,'cat');
print_r($redis->zrange('zset',0,-1));
echo "<br/>";
//释放是所有键，防止list无限延长
$redis->flushall();
?>
