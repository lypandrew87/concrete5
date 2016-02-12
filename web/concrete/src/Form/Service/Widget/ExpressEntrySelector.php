<?php
namespace Concrete\Core\Form\Service\Widget;

use Concrete\Core\Entity\Express\Entity;
use Concrete\Core\Entity\Express\Entry;
use Core;
use Page;
use Permissions;

class ExpressEntrySelector
{

    public function selectEntry(Entity $entity, $fieldName, Entry $entry = null)
    {
        $v = \View::getInstance();
        $v->requireAsset('core/express');

        $args['entityID'] = $entity->getID();
        $args['inputName'] = $fieldName;
        if ($entry) {
            $args['exEntryID'] = $entry->getID();
        }
        $args = json_encode($args);

        $identifier = new \Concrete\Core\Utility\Service\Identifier();
        $identifier = $identifier->getString(32);
        $html = <<<EOL
        <div data-express-entry-selector="{$identifier}"></div>
        <script type="text/javascript">
        $(function() {
            $('[data-express-entry-selector={$identifier}]').concreteExpressEntrySelector({$args});
        });
        </script>
EOL;

        return $html;
    }


}
