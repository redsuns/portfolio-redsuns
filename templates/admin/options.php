<?php
    $post_data = $_POST;
    if ( !empty($post_data) ) {
        
        $data = array(
            'label' => filter_input(INPUT_POST, 'label', FILTER_SANITIZE_STRING),
            'singular_label' => filter_input(INPUT_POST, 'singular_label', FILTER_SANITIZE_STRING),
            'rewrite' => true,
            'hierarchical' => true
        );
        
        if ( set_portfolio_taxonomies($data) ) {
            echo '<br /><div class="update-nag">Taxonomia Adicionada com sucesso</div>';
        }
    }
    
    $query_var = $_GET;
    if ( !empty($query_var['acao']) && $query_var['acao'] == 'remover' && !empty($query_var['sl'])) {
        $item_to_remove = trim(addslashes(base64_decode($_GET['sl'])));
        if ( remove_portfolio_taxonomy( $item_to_remove ) ) {
            echo '<br /><div class="update-nag">Taxonomia Removida com sucesso</div>';
        }
    }
?>

<h1>Configurações do portfolio</h1>

<table class="widefat" style="width: 99%">
    <thead>
        <tr>
            <th>Personalize as suas opções de portfolio</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
                <h4>Adicionar nova taxonomia</h4>
                <form action="" method="post">
                    Título (padrão): 
                    <br />
                    <input type="text" name="label" maxlength="100" style="width: 90%;">
                    <br /><br />
                    
                    Título no singular: 
                    <br />
                    <input type="text" name="singular_label" maxlength="100" style="width: 90%;">
                    <br />
                    <br />
                    <input type="submit" value="Adicionar" class="button-primary" />
                </form>
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <h4>Taxonomias existentes</h4>
                
                <?php if ( $portfolio_options = get_portfolio_taxonomies() ) : ?>
                    <?php foreach($portfolio_options as $tax) : ?>
                        <?php echo $tax['label']; ?>&nbsp;-&nbsp;
                        <a href="?page=portfolio-redsuns/portfolio-redsuns.php&acao=remover&sl=<?php echo base64_encode($tax['singular_label']); ?>"
                           onclick="return confirm('Deseja realmente remover a taxonomia \'<?php echo $tax['label']; ?>\'? Todos os conteúdos relacionados à ela perderão a visibilidade.')">Remover</a>
                        <br />
                    <?php endforeach; ?>
                    <br />
                <?php else : ?>
                    <h4>Não há taxonomias cadastradas até o momento</h4>
                <?php endif; ?>
                
            </td>
        </tr>
    </tbody>
    
    <tfoot>
        <tr>
            <th>Desenvolvido e mantido por <a href="http://www.redsuns.com.br" target="_blank">Redsuns</a> </th>
        </tr>
    </tfoot>
</table>