# This file is generated by gyp; do not edit.

TOOLSET := target
TARGET := action_after_build
### Generated for copy rule.
/Applications/XAMPP/xamppfiles/htdocs/e-kinerja/node_modules/fsevents/lib/binding/Release/node-v83-darwin-x64/fse.node: TOOLSET := $(TOOLSET)
/Applications/XAMPP/xamppfiles/htdocs/e-kinerja/node_modules/fsevents/lib/binding/Release/node-v83-darwin-x64/fse.node: $(builddir)/fse.node FORCE_DO_CMD
	$(call do_cmd,copy)

all_deps += /Applications/XAMPP/xamppfiles/htdocs/e-kinerja/node_modules/fsevents/lib/binding/Release/node-v83-darwin-x64/fse.node
binding_gyp_action_after_build_target_copies = /Applications/XAMPP/xamppfiles/htdocs/e-kinerja/node_modules/fsevents/lib/binding/Release/node-v83-darwin-x64/fse.node

### Rules for final target.
# Build our special outputs first.
$(obj).target/action_after_build.stamp: | $(binding_gyp_action_after_build_target_copies)

# Preserve order dependency of special output on deps.
$(binding_gyp_action_after_build_target_copies): | $(builddir)/fse.node

$(obj).target/action_after_build.stamp: TOOLSET := $(TOOLSET)
$(obj).target/action_after_build.stamp: $(builddir)/fse.node FORCE_DO_CMD
	$(call do_cmd,touch)

all_deps += $(obj).target/action_after_build.stamp
# Add target alias
.PHONY: action_after_build
action_after_build: $(obj).target/action_after_build.stamp

# Add target alias to "all" target.
.PHONY: all
all: action_after_build

