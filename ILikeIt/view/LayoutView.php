<?php
namespace view;
class LayoutView {

    public function render($outputMain, $outputAside){
        echo'<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>Min lista</title>
                    <link rel="stylesheet" href="content/css/style.css" />
                </head>
                <body>
                    <div id="content">
                        ' . $this->renderHeader() . '
                        <main>
                            ' . $outputMain . '
                        </main>
                        <aside>' . $outputAside . '</aside>
                        ' . $this->renderFooter() . '
                    </div>
                 </body>
              </html>
            ';
    }

    private function renderHeader(){
        return '<header>
                    <img src="content/css/images/logotype.svg" alt="Logotyp för minlista.se">
                </header>';
    }

    private function renderFooter(){
        return '<footer>
                    <p><a href="http://www.minlista.se">Minlista.se</a>,
                     av <a href="http://www.lisawestlund.se">Lisa Westlund</a></p>
                </footer>';
    }
}

