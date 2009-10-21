<div class="<?php _p($_FORM->RenderTopicCss($_ITEM)); ?>" title="<?php _p($_ITEM->SidenavTitle); ?>" onmouseover="topicOver(this);" onmouseout="topicOut(this);" onclick="document.location='<?php _p($_FORM->RenderTopicLink($_ITEM)); ?>'">
	<div class="title"><a href="<?php _p($_FORM->RenderTopicLink($_ITEM)); ?>" title="<?php _p($_ITEM->SidenavTitle); ?>"><?php _p(QString::Truncate($_ITEM->Name, ($_ITEM->IsViewed() ? 30 : 25)), false); ?></a></div>
	<div class="count"><?php _p($_ITEM->MessageCount);?></div>
</div>