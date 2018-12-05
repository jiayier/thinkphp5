# 一级标题

## 二级标题

### 三级标题

- 列表项1
- 列表项2
- 列表项3

> 这是一段引用

dog | bird    | cat
----|------|----
foo | foo | foo
bar | bar | bar
baz | baz | baz

| name  | age | gender    | money  |
|-------|:---:|-----------|-------:|
| rhio  | 384 | robot     | $3,000 |
| haroo | .3  | bird      | $430   |
| jedi  | ?   | undefined | $0     |






| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 3 is      | right-aligned | $1600 |
| col 2 is      | centered      |   $12 |
| zebra stripes | are neat      |    $1 |








​```python
def detail(request, pk):
    post = get_object_or_404(Post, pk=pk)
    post.body = markdown.markdown(post.body,
                                  extensions=[
                                      'markdown.extensions.extra',
                                      'markdown.extensions.codehilite',
                                      'markdown.extensions.toc',
                                  ])
    return render(request, 'blog/detail.html', context={'post': post})
​```

## html safe 标签的使用。

我们在发布的文章详情页没有看到预期的效果，而是类似于一堆乱码一样的 html 标签，这些标签本应该在浏览器显示它本身的格式，但是 django 出于安全方面的考虑，任何的 html 代码在 django 的模板中都会被转义（即输入原始的 html 文档代码，而不是经浏览器渲染后的格式），为了解除转义，只需在模板标签使用 safe 过滤器即可，告诉 django，这段文本是安全的，你什么也不用做。在模板中找到展示博客文章主体的 {{ post.body }} 部分，为其加上 safe 过滤器，{{ post.body|safe }}，大功告成，这下看到预期效果了。

![](http://upload-images.jianshu.io/upload_images/1008138-ec21a310f98cb005.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 代码高亮

程序员写博客免不了要插入一些代码，markdown 的语法使我们容易地书写代码块，但是目前来说，显示的代码块里的代码没有任何颜色，很不美观，也难以阅读，要是能够像我们的编辑器里一样让代码高亮就好了。虽然我们在渲染时使用了 codehilite 拓展，但这只是实现代码高亮的第一步，还需要简单的几步才能达到我们的最终目的。

首先我们需要安装 Pygments，进入虚拟环境，运行： `pip install Pygments`

搞定了，虽然我们除了安装了一下 Pygments 什么也没做，但 Markdown 使用 Pygments 在后台为我们做了很多事。如果你打开博客详情页，找到一段代码段，在浏览器查看这段代码段的 html 源代码，可以发现 Pygments 的工作原理是把代码切分成一个个单词，然后为这些单词添加 css 样式，不同的词应用不同的样式，这样就实现了代码颜色的区分，即高亮了语法。为此，还差最后一步，引入一个样式文件来给这些被添加了样式的单词定义颜色。我比较喜欢 friendly 样式，当然你也可以选择自己喜欢的 css 文件下载并引入。

在 blog/css 目录下新建一个 friendly.css 文件，把[这个里面的内容](https://github.com/zmrenwu/django-blog-tutorial/blob/Step9_markdown-and-code-highlight-supported/blog/static/blog/css/friendly.css)复制进去，保存文件，然后在 base.html 中把样式文件文件引入，记得使用前面介绍过的 {% static %} 模板标签来引入静态文件：

```html
base.html

<link rel="stylesheet" href="{% static 'blog/css/pace.css' %}">
<link rel="stylesheet" href="{% static 'blog/css/custom.css' %}">

+ <link rel="stylesheet" href="{% static 'blog/css/friendly.css' %}">

```