# A blog in PHP

<h1>Description: Allround blog in php/mysql for multiple bloggers.</h1>

<img src="/blog1.png" alt="screenshot of my blog in php" width="400px">
<img src="/blog2.png" alt="screenshot of my blog in php" width="400px">
<img src="/blog3.png" alt="screenshot of my blog in php" width="400px">

<h2>Functionality</h2>

<h3>Readers</h3>

<p>The landingspage shows the titel, header image and excerpt of all recent articels, sorted on recent first. By clinking on the titel or text, you wil navigate to the actual blog for a full read.Each blog has a titel, a header image, one or more categories, an excerpt and an author.</p>

<h4>Navigation</h4>
<p>The mainmenu in the top contains two buttons: home and admin. The admin button brings you to the login and register forms for (future) bloggers.</p>
<p>The sidebar menu contains a search field, a list of all the bloggers and a list of the categories. By clinkin on a blogger or category, the site will show you the blogs belongin to that particular blogger or category. These search and selecting menu's function with AJAX call and the page won't be refreshed when navigating.</p>

<h4>Searching</h4>
<p>In the left sidebar menu, a search field is added to search the content of the website. With this form, you can search in excerpts and the text of all blogs. The results are displayed as clickable rows.</p>

<h4>Commenting</h4>
<p>Readers can comment on blogs, provided the blogger has not closed the blog for commenting. To leave a comment, a reader needs to register or login to the application. Each commentingsection under a blog either displays the register and login forms, or the form to upload a comment, depending on whether or not the reader is already logged in. Login is done using an username, emailaddress and password. Once logged in, a reader can leave as manny comments as she/he likes.</p>

<h3>Bloggers</h3>
<p>Bloggers can register using the registration form that will show up once you click the 'Admin' button in the main menu. If a blogger is already registerd, she/he can simply login using the login form. Each blogger has an account with his/her name, username, email and password.</p>
<p>There are multiple options for bloggers. The left menu has the following options:</p>
<ul>
<li>ACCOUNT: to view your settings and create or delete categories</li>
<li>MANAGE BLOGS: to     
    <ul>
        <li>edit a blog</li>
        <li>delete a blog</li>
        <li>manage the comments per blog</li>
        <li>close a blog for commenting. If you close the blog for commenting, the comment option for readers will be invisible and no new comments can be added to the blog.</li>
    </ul>
</li>
  <li>UPLOAD BLOG: to upload a new blog with an image and categories</li>
  <li>CATEGORIES: to delete or create categories</li>
  </ul>

<h2>Content of application:</h2>
<ul>
	<li>Landingspage with link to blogs</li>
	<li>A search option</li>
	<li>A menu to select a blogger or category</li>
	<li>A page to read, register or login as reader and comment on one blog</li>
	<li>A page to register or login for bloggers</li>
	<li>An accountpage for the blogger</li>
	<li>A page to manage the comments and commentingsection of your blogs</li>
	<li>A page to manage your blogs with the option to edit, or delete a blog</li>
	<li>A page to delete or create new categories</li>
</ul>

<h3>Text Expander</h3>
<p>When entering your blog content with the upload-a-new-blog-form, a feature is activated to extend certain text to full words and centences. So far, these shortcuts are operational:</p>
 <ul>
        <li>"cg" : "CodeGorilla"</li>
        <li>"vrg" : "Vriendelijke groeten"</li>
    <li>"hrt" : "hartelijke groeten"</li>
    <li>"esm" : "Esmeralda Tijhoff"</li>
    <li>"gea" : "geachte heer/mevrouw"</li>
    <li>"gro" : "Groningen"</li>
    <li>"www.es" : "http://www.esmeraldatijhoff.nl"</li>
    <li>"wwww.wij" : "http://wijzijncodegorilla.nl/esmeraldatijhoff"</li>
</ul>

<h2>Resources</h2>
<p>Checklist and progress recorded on trello: https://trello.com/b/zW2XmbyL<br />
Demo of this blog on www.wijzijncodegorilla.nl/esmeraldatijhoff/blog/<br />

    </p>

<h2>Tools</h2>
<p>PHP using PDO<br />
MySQL database<br />
JavaScript<br />
jQuery<br />
AJAX<br />
CSS3<br />
HTML5</p>

