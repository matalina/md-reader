---
titles:
    book: Notebook
    chapter: A Home Page
    scene: Welcome
---

# MD Reader

MD Reader is a Laravel based static file reader.  The goal of this reader is read markdown and yaml based files and display them on the web.

All files are located in a storage device currently set up as the local storage, but with a simple modification it can use files from any flysystem adapter available.All

I would like to create git hooks so that the files on the server are automatically updated when something is pushed to a git repo on the master branch.

At present directory structure is unlimited but the deeper the files the longer the url.

You can use any valid Front YAML at the top of every document to add meta data to each document.  At present they are just a list of display information.  It is the goal to be able to link these all together at a future date.You

All body formatting should be done in Commonmark Markdown Syntax.All

Examples are provided in the docs folder of the notebook provided.Examples

Each page should either be ALL markdown or in the following format:

    ---
    meta: data
    goes:
        here: like this
        and: this
    ---
    
    # Title of the page
    
    etc...
        