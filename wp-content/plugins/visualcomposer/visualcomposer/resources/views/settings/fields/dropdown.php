<?php
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/** @var array $enabledOptions */
/** @var string $value */
/** @var string $name */
/** @var string $emptyTitle */
?>

<div class="vcv-ui-form-group<?php echo isset($description) ? ' vcv-ui-form-switch-container-has-description' : ''; ?>">
    <select class="vcv-ui-form-dropdown" id="<?php echo $name; ?>" name="<?php echo $name; ?>">
        <?php if (isset($emptyTitle)) : ?>
            <option value=""><?php echo $emptyTitle; ?></option>
        <?php endif; ?>
        <?php if (!empty($enabledOptions)) : ?>
            <?php foreach ($enabledOptions as $option) : ?>
                <?php $selected = ($option['id'] === $value) ? 'selected' : ''; ?>
                <?php $url = isset($option['url']) ? 'data-url="' . $option['url'] . '"' : ''; ?>
                <option value="<?php echo $option['id']; ?>" <?php echo $url ?> <?php echo $selected; ?>><?php echo $option['title']; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>

    <?php if (isset($description)) { ?>
        <p class="description"><?php echo $description; ?></p>
    <?php } ?>
</div>
