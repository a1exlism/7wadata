# 7wa data analysis platform


## Technology Stack
This is a Single Page application.

file structure
```shell
front-end:[Reference](https://segmentfault.com/a/1190000005969488)
  React + Webpack + antsUI

  build/
   -webpack.config.js
    - (webpack.dev.js)
    - (webpack.release.js)
  src/            front-end core library
    -conf         temporary not useful
    -imgs/css/js  public third libs
  node_modules/
  package.json

back-end:
  CodeIgniter : RESTful api design
  admin/  manager controller
  user/   user    controller
  views/  useless, just for CI compatibility
  system/ CI system php

Init:
  SQLdata/  about database
```

## file tree likes
[CodeIgniter+React](http://stackoverflow.com/questions/30504206/codeigniter-and-react-js-setup)
[SPA-file-structure](https://segmentfault.com/a/1190000005969488)
[webpack+react](https://juejin.im/post/581fd8b9bf22ec0068d5fff2)
