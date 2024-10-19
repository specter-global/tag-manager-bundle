<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle;

use SpecterGlobal\Bundle\TagManagerBundle\DependencyInjection\CompilerPass\TemplateCompilerPass;
use SpecterGlobal\Bundle\TagManagerBundle\Model\UrlPosition;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SpecterGlobalTagManagerBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        /** @phpstan-ignore-next-line */
        $definition->rootNode()
            ->children()
                ->booleanNode('enabled')
                    ->info('Enable or Disable Tag Manager')
                    ->defaultFalse()
                ->end()
                ->scalarNode('tag_id')
                    ->info('Tag Manager ID')
                    ->cannotBeEmpty()
                    ->defaultValue('DUMMY_TAG_MANAGER_ID')
                ->end()
                ->arrayNode('cookie_flags')
                    ->info('Tag Manager Cookie flags')
                    ->prototype('scalar')
                        ->defaultValue([])
                    ->end()
                ->end()
                ->arrayNode('linker')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('accept_incoming')
                            ->info('Accept incoming')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('decorate_forms')
                            ->info('Decorate forms')
                            ->defaultFalse()
                        ->end()
                        ->enumNode('url_position')
                            ->info('Url position')
                            ->defaultValue(UrlPosition::QUERY)
                            ->values(UrlPosition::CASES)
                        ->end()
                        ->arrayNode('domains')
                            ->info('Domains')
                            ->prototype('scalar')
                                ->defaultValue([])
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * @param array<array-key, array<array-key, mixed>> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../../config/services.yaml');
        $container->parameters()
            ->set('specter_global_tag_manager.enabled', $config['enabled'])
            ->set('specter_global_tag_manager.tag_id', $config['tag_id'])
            ->set('specter_global_tag_manager.cookie_flags', $config['cookie_flags'])
            ->set('specter_global_tag_manager.linker.accept_incoming', $config['linker']['accept_incoming'])
            ->set('specter_global_tag_manager.linker.decorate_forms', $config['linker']['decorate_forms'])
            ->set('specter_global_tag_manager.linker.url_position', $config['linker']['url_position'])
            ->set('specter_global_tag_manager.linker.domains', $config['linker']['domains']);
    }

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new TemplateCompilerPass($this->getPath(), $this->getName()));
    }
}
