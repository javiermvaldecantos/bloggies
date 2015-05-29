# bloggies
Blog web site generated using PHP. Allows the user to read blogs and submit his own blog, which can contain an image.

* Project structure:
  * index.php: This is the home page of my web application. It displays the last five blog entries from the “content” folder. One blog entry has at least two elements: the title and the text of the blog. There may be an optional image file, which is displayed too if it exists.

  * blog.php: This page will only display one blog entry (title + text + optional image). The user may go to this page after clicking on the title of any blog entry in the index.php page. Besides, the user will end in this page after submitting a new blog entry (see description of the admin.php page below).

  * /admin directory
    * admin.php: This page contains the necessary code to let the user submit a blog entry. After submitting the blog entry, the user will be redirected to blog.php, to view his new blog entry displayed on the web site.
  
  * /content directory
    * /blogs directory: contains one folder for each sumbitted blog entry. In each folder we can find the blog's title, the blog entry and an optional image (if the user sumbitted it). 
    * /css directory: contains a very basic CSS file for the web site.
  
  * /lib directory
    * layout.php: Contains any function related to the web page layout 
    * tools.php: Contains any other function such as file reading and file writing functions
