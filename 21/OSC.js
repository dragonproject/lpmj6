// どんな i をもらっても、getElementById でとってきて返す関数
function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }

// オブジェクトの style を返す関数
function S(i) { return O(i).style                                            }

// クラス名から要素を返す関数
function C(i) { return document.getElementsByClassName(i)                    }
