<?php $settings = BebelSingleton::getInstance('BebelSettings'); ?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-search">
    <label><input type="search" class="input-xlarge search-query" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', $settings->getPrefix() ); ?>" /></label>
    <input type="submit" class="btn btn-danger" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', $settings->getPrefix() ); ?>" />
</form>
